const through = require('through2')
const aws = require('aws-sdk')
const log = require('fancy-log')

// CloudFront のキャッシュを削除する
// https://github.com/lpender/gulp-cloudfront-invalidate-aws-publish/blob/master/index.js
module.exports = (options) => {
  const cloudfront = new aws.CloudFront()
  let files = []
  cloudfront.config.update({
    credentials: options.credentials,
  })

  const complain = (err, msg, callback) => {
    callback(false)
    throw new Error('gulp-cloudfront-invalidate', msg + ': ' + err)
  }

  const processFile = (file, encoding, callback) => {
    if (!file.s3) return callback(null, file)
    if (!file.s3.state) return callback(null, file)
    if (options.states && options.states.indexOf(file.s3.state) === -1)
      return callback(null, file)

    switch (file.s3.state) {
      case 'update':
      case 'create':
      case 'delete': {
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
      }
      case 'cache':
      case 'skip':
        break
      default:
        log('Unknown state: ' + file.s3.state)
        break
    }

    return callback(null, file)
  }

  const invalidate = (callback) => {
    if (files.length == 0) return callback()

    files = files.map((file) => {
      return '/' + file
    })

    cloudfront.createInvalidation(
      {
        DistributionId: options.distribution,
        InvalidationBatch: {
          CallerReference: Date.now().toString(),
          Paths: {
            Quantity: files.length,
            Items: files,
          },
        },
      },
      (err, res) => {
        if (err)
          return complain(err, 'Could not invalidate cloudfront', callback)

        log('Cloudfront invalidation created: ' + res.Invalidation.Id)

        return callback()
      }
    )
  }
  return through.obj(processFile, invalidate)
}
