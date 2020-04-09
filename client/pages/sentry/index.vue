<template>
  <div>
    <div class="detail">
      <div class="detail-content">
        <h3 class="detail-header">このレクチャーの内容・補足</h3>
        <div class="detail-body">
          <p>{{ lecture.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.video-wrap {
  border-radius: 0.5rem 0.5rem 0 0;
  overflow: hidden;
  position: relative;

  &:hover {
    .video-btns {
      opacity: 1;
    }
  }
}

.video {
  padding: 56.25% 0 0 0;
  position: relative;
}

.video-btns {
  display: none;
}

@media screen and (min-width: 769px) {
  .video-btns {
    display: block;
    opacity: 0;
    transition: opacity 0.3s ease 0s;
  }
}

.video-btn {
  background-color: $color-teal2;
  display: flex;
  height: 64px;
  position: absolute;
  top: calc(50% - 32px);
}

.video-btn-prev {
  margin-right: 0.5rem;
}

.video-btn-next {
  margin-left: 0.5rem;
  right: 0;
}

.video-btn-link {
  align-items: center;
  display: flex;
  padding-left: 1.8rem;
  padding-right: 1.8rem;

  i {
    color: $color-white1;
  }
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

.detail-btns {
  display: flex;
  margin-bottom: 2.8rem;
}

@media screen and (min-width: 769px) {
  .detail-btns {
    display: none;
  }
}

.detail-btn-link {
  align-items: center;
  background-color: $color-gray1;
  border-radius: 0.8rem;
  color: $color-gray3;
  display: flex;
  flex: 1 1 0%;
  height: 5rem;
  justify-content: center;
  transition: background-color 0.3s, border 0.3s;
}

.detail-btn-prev {
  margin-right: 1rem;
}

.detail-header {
  background-color: $color-white2;
  border-radius: 0.8rem;
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

.loading {
  align-items: center;
  color: $color-teal1;
  display: flex;
  justify-content: center;
  left: 47%;
  position: absolute;
  top: 50%;
}

.error-box-wrap {
  margin: 4rem;
}
</style>

<script>
import ErrorBox from "@/components/commons/ErrorBox.vue"
import VerificationEmailBox from "@/components/partials/course/VerificationEmailBox.vue"
import { mapState, mapGetters } from "vuex"

export default {
  layout: "course",
  components: {
    ErrorBox,
    VerificationEmailBox
  },
  data() {
    return {
      course: {},
      lecture: {},
      loading: true,
      error: null
    }
  },
  computed: {
    ...mapState("auth0", ["auth0User"]),
    ...mapGetters("auth0", ["isAuth0Provider"])
  },
  async created() {
    await this.$axios.$get(`/debug-sentry`).catch(err => {
      console.log(1)
      this.$sentry.captureException(err)
    })
  }
}
</script>
