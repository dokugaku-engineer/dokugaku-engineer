const {
  src
} = require("gulp")
const awspublish = require("gulp-awspublish")
const parallelize = require("concurrent-transform")
const through = require('through2')
const aws = require('aws-sdk')
const log = require('fancy-log')

const config = {
  distDir: "dist",
  concurrentUploads: 10,
  headers: {
    /* 'Cache-Control': 'max-age=315360000, no-transform, public', */
  },
}

const awspublishConfig = {
  params: {
    Bucket: process.env.AWS_CLIENT_BUCKET_NAME
  },
  region: process.env.AWS_DEFAULT_REGION,
  cacheFileName: ".awspublish",
}

const cfConfig = {
  credentials: {
    accessKeyId: process.env.AWS_ACCESS_KEY_ID,
    secretAccessKey: process.env.AWS_SECRET_ACCESS_KEY,
    signatureVersion: "v3"
  },
  distribution: process.env.AWS_CLOUDFRONT, // CloudFront distribution ID
  indexRootPath: true,
  wait: true, // CloudFront のキャッシュ削除が完了するまでの時間（約30〜60秒）
}

// CloudFront のキャッシュを削除する
// https://github.com/lpender/gulp-cloudfront-invalidate-aws-publish/blob/master/index.js
const cfInvalidation = (options) => {
  const cloudfront = new aws.CloudFront();
  let files = []
  cloudfront.config.update({
    credentials: options.credentials
  });

  const complain = (err, msg, callback) => {
    callback(false);
    throw new Error('gulp-cloudfront-invalidate', msg + ': ' + err)
  }

  const check = (id, callback) => {
    cloudfront.getInvalidation({
      DistributionId: options.distribution,
      Id: id
    }), (err, res) => {
      if (err) return complain(err, 'Could not check on invalidation', callback)

      if (res.Invalidation.Status === 'Completed') {
        return callback()
      } else {
        setTimeout(() => {
          check(id, callback)
        }, 1000)
      }
    }
  }

  const processFile = (file, encoding, callback) => {
    if (!file.s3) return callback(null, file)
    if (!file.s3.state) return callback(null, file)
    switch (file.s3.state) {
      case 'update':
      case 'create':
      case 'delete':
        let path = file.s3.path

        // ディレクトリのないファイル、_nuxt/ から始まるファイルはそのまま追加する
        if (!/.*\/.*/.test(path) || /^_nuxt\//.test(path)) {
          files.push(path)
          break
        }

        // ファイル数が多すぎるとCloudFrontのinvalidation数の上限超過エラーになるので、上記以外のファイルは第一ディレクトリ以下をワイルドカードに置換してから追加する
        // / も置換対象に含めているのは、スラッシュなしのファイルもLambda@EdgeでCloudFrontにキャッシュしているから
        // 例. course/serverside/lecture/8uHMV/index.html → course*
        path = path.replace(/\/.*?.*/, '*')
        if (!files.includes(path)) {
          files.push(path)
        }
        break
      case 'cache':
      case 'skip':
        break
      default:
        log('Unknown state: ' + file.s3.state)
        break
    }

    return callback(null, file);
  }

  const invalidate = (callback) => {
    if (files.length == 0) return callback();

    files = files.map((file) => {
      return '/' + file
    })

    cloudfront.createInvalidation({
      DistributionId: options.distribution,
      InvalidationBatch: {
        CallerReference: Date.now().toString(),
        Paths: {
          Quantity: files.length,
          Items: files
        }
      }
    }, (err, res) => {
      if (err) return complain(err, 'Could not invalidate cloudfront', callback)

      log('Cloudfront invalidation created: ' + res.Invalidation.Id)

      check(res.Invalidation.Id, callback);
    })
  }
  return through.obj(processFile, invalidate);
}

const deploy = () => {
  // S3 オプションを使用して新しい publisher を作成する
  // http://docs.aws.amazon.com/AWSJavaScriptSDK/latest/AWS/S3.html#constructor-property
  const publisher = awspublish.create(awspublishConfig)

  return src("./" + config.distDir + "/**")
    .pipe(parallelize(publisher.publish(config.headers), config.concurrentUploads)) // S3にアップロードする
    .pipe(cfInvalidation(cfConfig)) // CloudFrontのキャッシュを削除する
    .pipe(publisher.sync()) // S3をdist以下のファイルに同期し、古いファイルを削除する
    .pipe(publisher.cache()) // 連続したアップロードを高速化するためにキャッシュファイルを作成する
    .pipe(awspublish.reporter()) // アップロードの更新をコンソールに出力する
}

exports.deploy = deploy