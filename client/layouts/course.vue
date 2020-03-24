<template>
  <div class="wrap">
    <header class="header">
      <nuxt-link :to="`/course/${course.name}`">
        <h2 class="header-logo">
          <logo />
        </h2>
      </nuxt-link>
      <div>
        <i @click="toggleMenu" class="far fa-bars bars-regular"></i>
        <transition name="fade">
          <div v-if="showMenu" class="menu">
            <i @click="toggleMenu" class="fal fa-times fa-lg cross"></i>
            <div class="menu-inner">
              <div class="menu-boarder">
                <div class="menu-item">
                  <nuxt-link
                    :to="`/course/${course.name}`"
                    @click.native="toggleMenu"
                  >
                    <h2 class="menu-item-title">ホーム</h2>
                  </nuxt-link>
                </div>
              </div>
              <div class="menu-boarder">
                <div v-for="lesson in lessons" class="menu-item">
                  <lecture-list :lessonLectures="lesson" @hideMenu="toggleMenu" />
                </div>
              </div>
              <div class="menu-item">
                <nuxt-link to="/settings/profile">
                  <h2 class="menu-item-title">プロフィール</h2>
                </nuxt-link>
              </div>
              <div class="menu-item">
                <button class="menu-item-title" @click="logout">ログアウト</button>
              </div>
            </div>
          </div>
        </transition>
      </div>
      <h1 class="header-title">{{ lectureName }}</h1>
      <i @click="toggleSetting" ref="bars" class="fas fa-bars fa-lg bars-solid"></i>
      <div v-if="showSetting" v-click-outside="{ exclude: ['bars'], handler: 'closeSetting' }" class="setting">
        <nuxt-link to="/settings/profile" class="setting-link">プロフィール</nuxt-link>
        <button @click="logout" class="setting-link">ログアウト</button>
      </div>
    </header>
    
    <div class="main">
      <nav class="sidebar">
        <div class="menu-boarder">
          <div class="lesson">
            <nuxt-link :to="`/course/${course.name}`">
              <h2 class="menu-item-title" :class="courseTop ? 'play' : ''">コースについて</h2>
            </nuxt-link>
          </div>
        </div>
        <div v-for="lesson in lessons" class="lesson">
          <lecture-list :lessonLectures="lesson" />
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
    margin-right: 1.5rem;
    width: 32rem;
  }
}

.header {
  align-items: center;
  background-color: $color-white1;
  display: flex;
  padding: 1rem 1rem;
  text-align: left;
}

.header-title {
  font-weight: 700;
  text-align: center;
  width: 100%;
}

.bars-regular {
  color: $color-red1;
  display: block;
  margin: .6rem 1rem .6rem 0;
}

@media screen and (min-width: 769px) {
  .bars-regular {
    display: none;
  }
}

.bars-solid {
  display: none;
}

@media screen and (min-width: 769px) {
  .bars-solid {
    color: $color-gray3;
    cursor: pointer;
    display: block;
    margin: .6rem 1rem .6rem 0;
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
  overflow-x: hidden !important;
  overflow-y: auto !important;
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

.menu-item {
  margin-bottom: 1.2rem;
}

.menu-boarder {
  border-bottom: 1px solid $color-gray1;
  margin-bottom: 1.2rem;
}

.menu-item-title {
  align-items: center;
  background-color: $color-white2;
  border-radius: .8rem;
  display: flex;
  font-weight: 700;
  margin-bottom: 1rem;
  padding: .8rem 1.6rem;
  width: 100%;

  &:focus {
    outline: 0;
  }

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

.setting {
  background-color: rgb(255, 255, 255);
  border-radius: .2rem;
  box-shadow: rgba(0, 0, 0, 0.16) 0 .3rem 1rem;
  min-width: 16.5rem;
  position: absolute;
  right: 0;
  top: 4.8rem;
  z-index: 3000;
}

.setting-link {
  display: block;
  font-size: $font-size-sm;
  padding: 1.4rem 2rem;
  text-align: left;
  width: 100%;

  &:focus {
    outline: 0;
  }
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
import auth0Middleware from '~/middleware/auth0'
import { mapState } from 'vuex'

export default {
  components: {
    Logo,
    LectureList,
    Footer
  },
  data() {
    return {
      showMenu: false,
      showSetting: false
    }
  },
  middleware: auth0Middleware.protect(),
  computed: {
    ...mapState('course', ['course', 'courseTop', 'lessons', 'lectureName'])
  },
  methods: {
    async logout() {
      await this.$auth0.logout({ returnTo: window.location.origin })
    },
    closeSetting() {
      this.showSetting = false
    },
    toggleSetting() {
      this.showSetting = !this.showSetting
    },
    toggleMenu() {
      this.showMenu = !this.showMenu
    }
  }
}
</script>
