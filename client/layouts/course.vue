<template>
  <div class="wrap">
    <header class="header">
      <nuxt-link :to="`/course/${course.name}`">
        <h2 class="header-logo">
          <logo />
        </h2>
      </nuxt-link>
      <div>
        <i class="far fa-bars bars-regular" @click="toggleMenu" />
        <transition name="fade">
          <div v-if="showMenu" class="menu">
            <i class="fal fa-times fa-lg cross" @click="toggleMenu" />
            <div class="menu-inner">
              <div class="menu-boarder">
                <div class="menu-item">
                  <nuxt-link
                    :to="`/course/${course.name}`"
                    @click.native="toggleMenu"
                  >
                    <h2 class="menu-item-title">
                      ホーム
                    </h2>
                  </nuxt-link>
                </div>
              </div>
              <div class="menu-boarder">
                <div
                  v-for="(lesson, index) in lessons"
                  :key="index"
                  class="menu-item"
                >
                  <lecture-list
                    :course="course"
                    :lesson="lesson"
                    :lecture="lecture"
                    :lectures="filteredLectures(lesson.id)"
                    :learned-lecture-ids="learnedLectureIds"
                    @hideMenu="toggleMenu"
                  />
                </div>
              </div>
              <div class="menu-item">
                <nuxt-link to="/settings/profile" @click.native="toggleMenu">
                  <h2 class="menu-item-title">
                    プロフィール
                  </h2>
                </nuxt-link>
              </div>
              <div class="menu-item">
                <nuxt-link to="/settings/password" @click.native="toggleMenu">
                  <h2 class="menu-item-title">
                    パスワード
                  </h2>
                </nuxt-link>
              </div>
              <div class="menu-item">
                <button class="menu-item-title" @click="logout">
                  ログアウト
                </button>
              </div>
            </div>
          </div>
        </transition>
      </div>
      <h1 class="header-title">
        {{ lectureName }}
      </h1>
      <i
        ref="bars"
        class="fas fa-bars fa-lg bars-solid"
        @click="toggleSetting"
      />
      <div
        v-if="showSetting"
        v-click-outside="{ exclude: ['bars'], handler: 'closeSetting' }"
        class="setting"
      >
        <nuxt-link
          to="/settings/profile"
          class="setting-link"
          @click.native="closeSetting"
        >
          プロフィール
        </nuxt-link>
        <nuxt-link
          to="/settings/password"
          class="setting-link"
          @click.native="closeSetting"
        >
          パスワード
        </nuxt-link>
        <button class="setting-link" @click="logout">
          ログアウト
        </button>
      </div>
    </header>

    <div class="main">
      <nav class="sidebar">
        <div class="menu-boarder">
          <div class="lesson">
            <nuxt-link :to="`/course/${course.name}`">
              <h2 class="menu-item-title" :class="courseTop ? 'play' : ''">
                コースについて
              </h2>
            </nuxt-link>
          </div>
        </div>
        <div v-for="(lesson, index) in lessons" :key="index" class="lesson">
          <lecture-list
            :course="course"
            :lesson="lesson"
            :lecture="lecture"
            :lectures="filteredLectures(lesson.id)"
            :learned-lecture-ids="learnedLectureIds"
          />
        </div>
      </nav>
      <div class="content">
        <nuxt />
      </div>
    </div>

    <div class="footer_wrap">
      <nui-footer />
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
  margin: 0.6rem 1rem 0.6rem 0;
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
    margin: 0.6rem 1rem 0.6rem 0;
  }
}

.cross {
  color: $color-red1;
  margin: 1.5rem 1rem 0.5rem;
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

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease-out;
}

.fade-enter,
.fade-leave-to {
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
  border-radius: 0.8rem;
  display: flex;
  font-weight: 700;
  margin-bottom: 1rem;
  padding: 0.8rem 1.6rem;
  width: 100%;

  &:focus {
    outline: 0;
  }

  h2,
  i {
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
  border-radius: 0.2rem;
  box-shadow: rgba(0, 0, 0, 0.16) 0 0.3rem 1rem;
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
    border-radius: 0.5rem;
    color: $color-gray2;
    display: block;
    font-size: $font-size-sm;
    margin-right: 1.5rem;
    overflow: auto;
    padding: 1rem;
    transition: all 0.2s;
    width: 32rem;
  }
}

.play {
  color: $color-black;
  font-weight: 700;
}

.content {
  background-color: $color-white1;
  border-radius: 0.5rem;
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
import NuiFooter from "@/components/layouts/Footer.vue"
import auth0Middleware from "~/middleware/auth0"
import { mapState, mapGetters } from "vuex"

export default {
  components: {
    Logo,
    LectureList,
    NuiFooter,
  },
  data() {
    return {
      showMenu: false,
      showSetting: false,
    }
  },
  middleware: auth0Middleware.protect(),
  computed: {
    ...mapState("course", [
      "course",
      "lessons",
      "lecture",
      "learnedLectureIds",
      "lectureName",
      "courseTop",
    ]),
    ...mapGetters("course", ["filteredLectures"]),
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
    },
  },
}
</script>
