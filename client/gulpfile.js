const {
  src
} = require("gulp")
const awspublish = require("gulp-awspublish")
const cloudfront = require("gulp-cloudfront-invalidate-aws-publish")
const parallelize = require("concurrent-transform")

// https://docs.aws.amazon.com/cli/latest/userguide/cli-environment.html

const config = {
  // 必須
  params: {
    Bucket: process.env.AWS_CLIENT_BUCKET_NAME
  },
  credentials: {
    accessKeyId: process.env.AWS_ACCESS_KEY_ID,
    secretAccessKey: process.env.AWS_SECRET_ACCESS_KEY,
    signatureVersion: "v3"
  },

  // 任意
  deleteOldVersions: false, // PRODUCTION で使用しない
  distribution: process.env.AWS_CLOUDFRONT, // CloudFront distribution ID
  region: process.env.AWS_DEFAULT_REGION,
  headers: {
    /* 'Cache-Control': 'max-age=315360000, no-transform, public', */
  },

  // 適切なデフォルト値 - これらのファイル及びディレクトリは gitignore されている
  distDir: "dist",
  indexRootPath: true,
  cacheFileName: ".awspublish",
  concurrentUploads: 10,
  wait: true // CloudFront のキャッシュ削除が完了するまでの時間（約30〜60秒）
}

const deploy = () => {
  // S3 オプションを使用して新しい publisher を作成する
  // http://docs.aws.amazon.com/AWSJavaScriptSDK/latest/AWS/S3.html#constructor-property
  const publisher = awspublish.create(config)

  let g = src("./" + config.distDir + "/**")
  // publisher は、上記で指定した Content-Length、Content-Type、および他のヘッダーを追加する
  // 指定しない場合、はデフォルトで x-amz-acl が public-read に設定される
  g = g.pipe(
    parallelize(publisher.publish(config.headers), config.concurrentUploads)
  )

  // CDN のキャッシュを削除する
  if (config.distribution) {
    console.log("Configured with CloudFront distribution")
    g = g.pipe(cloudfront(config))
  } else {
    console.log(
      "No CloudFront distribution configured - skipping CDN invalidation"
    )
  }

  // 削除したファイルを同期する
  console.log("1")
  if (config.deleteOldVersions) {
    console.log("2")

    g = g.pipe(publisher.sync())
  }
  // 連続したアップロードを高速化するためにキャッシュファイルを作成する
  console.log("3")
  g = g.pipe(publisher.cache())
  // アップロードの更新をコンソールに出力する
  console.log("4")
  g = g.pipe(awspublish.reporter())
  console.log("5")
  return g
}

exports.deploy = deploy