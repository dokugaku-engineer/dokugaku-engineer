<template>
  <div>
    <div class="video-wrap">
      <div class="video">
        <iframe src="https://player.vimeo.com/video/391168857?autoplay=1" frameborder="0" allow="autoplay; fullscreen" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
      </div>
    </div>
    <div class="detail">
      <div class="detail-content">
        <h3 class="detail-header">このレクチャーの内容</h3>
        <div class="detail-body">
          <p>コースを受講後にできるようになっていることを解説します。コースを完了すれば、みなさんのキャリアが変わっています！</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.video-wrap {
  border-radius: .5rem .5rem 0 0;
  overflow: hidden;
}

.video {
  padding: 56.25% 0 0 0;
  position: relative;
}

.detail {
  padding: 2rem 2rem;
}

@media screen and (min-width: 769px) {
  .detail {
    padding: 4.2rem 5.6rem;
  }
}

.detail-content {
  margin-bottom: 2.8rem;
}

@media screen and (min-width: 769px) {
  .detail-content {
    margin-bottom: 3.2rem;
  }
}

.detail-header {
  background-color: $color-white2;
  border-radius: .8rem;
  font-weight: 700;
  margin-bottom: 2rem;
  padding: 1.6rem 1.4rem;
}

@media screen and (min-width: 769px) {
  .detail-header {
    margin-bottom: 2.4rem;
    padding: 2rem 1.6rem;
  }
}

.detail-body {
}

@media screen and (min-width: 769px) {
  .detail-body {
    margin: 0 1.6rem;
  }
}
</style>

<script>
export default {
  layout: "course"
}
</script>
