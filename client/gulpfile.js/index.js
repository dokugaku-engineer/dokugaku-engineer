const {
  src
} = require("gulp")
const awspublish = require("gulp-awspublish")
const parallelize = require("concurrent-transform")
const {
  cfInvalidation
} = require("./cfInvalidation")

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
}

const deploy = (cb) => {
  // S3 オプションを使用して新しい publisher を作成する
  // http://docs.aws.amazon.com/AWSJavaScriptSDK/latest/AWS/S3.html#constructor-property
  const publisher = awspublish.create(awspublishConfig)

  src("./" + config.distDir + "/**")
    .pipe(parallelize(publisher.publish(config.headers), config.concurrentUploads)) // S3にアップロードする
    .pipe(cfInvalidation(cfConfig)) // CloudFrontのキャッシュを削除する
    .pipe(publisher.sync('')) // S3をdist以下のファイルに同期し、古いファイルを削除する

  cb()
}

exports.deploy = deploy