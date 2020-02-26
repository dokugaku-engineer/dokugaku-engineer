<template>
  <div class="wrap">
    <header class="header">
      <nuxt-link :to="`/course/${$store.state.course.course.name}`">
        <h2 class="header-logo">
          <logo />
        </h2>
      </nuxt-link>
      <div>
        <i @click="showMenu = !showMenu" class="far fa-bars bars"></i>
        <transition name="fade">
          <div v-if="showMenu" class="menu">
            <i @click="showMenu = !showMenu" class="fal fa-times fa-lg cross"></i>
            <div class="menu-inner">
              <div class="lesson-course">
                <div class="lesson">
                  <nuxt-link
                    :to="`/course/${$store.state.course.course.name}`"
                    @click.native="showMenu = false"
                  >
                    <h2 class="lesson-title">ホーム</h2>
                  </nuxt-link>
                </div>
              </div>
              <div v-for="(lesson, index) in $store.state.course.lessons" class="lesson">
                <LectureList :lessonLectures="lesson" @hideMenu="showMenu = false" />
              </div>
            </div>
          </div>
        </transition>
      </div>
      <h1 class="header-title">{{ $store.state.lecture.name }}</h1>
    </header>
    
    <div class="main">
      <nav class="sidebar">
        <div v-for="(lesson, index) in $store.state.course.lessons" class="lesson">
          <LectureList :lessonLectures="lesson" />
        </div>
      </nav>
      <div class="content">
        <nuxt />
      </div>
    </div>

    <div class="footer_wrap">
      <Footer />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.wrap {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.header-logo {
  display: none;
}

@media screen and (min-width: 769px) {
  .header-logo {
    display: block;
  }
}

.header {
  background-color: $color-white1;
  display: flex;
  align-items: center;
  padding: 1rem 1rem .5rem;
  text-align: left;
}

.header-title {
  font-weight: 700;
  text-align: center;
  width: 100%;
}

.bars {
  color: $color-red1;
  display: block;
  margin-right: 1rem;
}

@media screen and (min-width: 769px) {
  .bars {
    display: none;
  }
}

.cross {
  color: $color-red1;
  margin: 1.5rem 1rem .5rem;
}

.menu {
  background-color: rgb(255, 255, 255) !important;
  bottom: 0px !important;
  height: 100% !important;
  left: 0px !important;
  position: fixed !important;
  right: 0px !important;
  top: 0px !important;
  z-index: 10 !important;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .3s ease-out;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

.menu-inner {
  padding: 2rem;
}

.main {
  background-color: $color-white2;
  display: flex;
  flex-grow: 1;
  height: 100%;
  padding: 1.6rem 1rem;
}

.sidebar {
  display: none;
}

@media screen and (min-width: 769px) {
  .sidebar {
    background-color: $color-white1;
    border-radius: .5rem;
    color: $color-gray2;
    display: block;
    font-size: $font-size-sm;
    margin-right: 1.5rem;
    overflow: auto;
    padding: 1rem;
    transition: all .2s;
    width: 32rem;
  }
}

.lesson {
  margin-bottom: 1.2rem;
}

.lesson-course {
  border-bottom: 1px solid $color-gray1;
  margin-bottom: 1.2rem;
}

.lesson-title {
  align-items: center;
  background-color: $color-white2;
  border-radius: .8rem;
  display: flex;
  margin-bottom: 1rem;
  padding: .8rem 1.6rem;

  h2, i {
    display: inline-block;
  }

  h2 {
    margin-right: 1.6rem;
  }

  i {
    margin-left: auto;
  }
}

.play {
  color: $color-black;
  font-weight: 700;
}

.content {
  background-color: $color-white1;
  border-radius: .5rem;
  box-shadow: 0 1px 20px 0 $color-gray-shadow;
  flex: 1;
  margin: 0 auto;
  max-width: 1024px;
}

.footer_wrap {
  margin-top: auto;
}
</style>

<script>
import Logo from "@/components/svg/Logo.vue"
import LectureList from "@/components/partials/course/LectureList.vue"
import Footer from "@/components/layouts/Footer.vue"

export default {
  components: {
    Logo,
    LectureList,
    Footer
  },
  data() {
    return {
      showMenu: false,
    }
  }
}
</script>
