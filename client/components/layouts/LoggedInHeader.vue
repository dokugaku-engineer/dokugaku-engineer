<template>
  <header class="header fixed-top">
    <nuxt-link to="/course/serverside">
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
                <nuxt-link to="/course/serverside" @click.native="toggleMenu">
                  <h2 class="menu-item-title">ホーム</h2>
                </nuxt-link>
              </div>
            </div>

            <div v-if="!!Object.keys(lessons).length" class="menu-boarder">
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
                <h2 class="menu-item-title">プロフィール</h2>
              </nuxt-link>
            </div>

            <div class="menu-item">
              <nuxt-link to="/settings/password" @click.native="toggleMenu">
                <h2 class="menu-item-title">パスワード</h2>
              </nuxt-link>
            </div>

            <div class="menu-item">
              <nuxt-link to="/settings/billing" @click.native="toggleMenu">
                <h2 class="menu-item-title">お支払い情報</h2>
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
      {{ title }}
    </h1>
    <i ref="bars" class="fas fa-bars fa-lg bars-solid" @click="toggleSetting" />
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

      <nuxt-link
        to="/settings/billing"
        class="setting-link"
        @click.native="closeSetting"
      >
        お支払い情報
      </nuxt-link>

      <button class="setting-link" @click="logout">ログアウト</button>
    </div>
  </header>
</template>

<style lang="scss" scoped>
.header-logo {
  display: none;
}

@media screen and (min-width: 769px) {
  .header-logo {
    display: block;
  }
}

.header {
  align-items: center;
  background-color: $color-white1;
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  display: flex;
  padding: 1.2rem 0.8rem 1rem 2rem;
  text-align: left;
}

@media screen and (min-width: 769px) {
  .header {
    justify-content: space-between;
    padding: 2rem 0.8rem 1.6rem 2rem;
  }
}

.header-title {
  font-weight: 700;
  text-align: center;
  width: 100%;
}

.fixed-top {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 10;
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
  bottom: 0 !important;
  height: 100% !important;
  left: 0 !important;
  overflow-x: hidden !important;
  overflow-y: auto !important;
  position: fixed !important;
  right: 0 !important;
  top: 0 !important;
  z-index: 10 !important;
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
</style>

<script>
import Logo from '@/components/svg/Logo.vue'
import LectureList from '@/components/partials/course/LectureList.vue'
import { mapGetters } from 'vuex'

export default {
  components: {
    Logo,
    LectureList,
  },
  props: {
    title: {
      type: String,
      default: '',
    },
    course: {
      type: Object,
      default: () => ({}),
    },
    lessons: {
      type: Array,
      default: () => [],
    },
    lecture: {
      type: Object,
      default: () => ({}),
    },
    learnedLectureIds: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      showMenu: false,
      showSetting: false,
    }
  },
  computed: {
    ...mapGetters('course', ['filteredLectures']),
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
