<template>
  <div class="wrap">
    <header class="header">
      <h2 class="header-logo">
        <logo />
      </h2>
      <!-- <h1 class="header-title">コースについて</h1> -->
      <span class="header-title">コースについて</span>
    </header>
    
    <div class="main">
      <nav class="sidebar">
        <div class="lesson-course">
          <div class="lesson">
            <h2 class="lesson-title">コースについて</h2>
          </div>
        </div>
        <div v-for="(lesson, index) in lessons" class="lesson">
          <LectureList :lesson="lesson" />
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

.main {
  background-color: $color-white2;
  display: flex;
  flex-grow: 1;
  height: 100%;
  padding: 1.6rem 1rem;
}

.sidebar {
  background-color: $color-white1;
  border-radius: .5rem;
  color: $color-gray2;
  font-size: $font-size-sm;
  margin-right: 1.5rem;  
  width: 32rem;
  overflow: auto;
  padding: 1rem;
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
  box-shadow: 0 1px 20px 0 $color-gray-shadow;
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
      lessons: [
        {
          lessonNo: 1,
          lessonTitle: "コースについて",
          lessonPlay: true,
          lectures: [
            {
              lectureNo: 1,
              lectureTitle: "コースへようこそ",
              lecturePlay: false
            },
            {
              lectureNo: 2,
              lectureTitle: "コースのゴール",
              lecturePlay: true
            },
            {
              lectureNo: 3,
              lectureTitle: "コースを通じて作るものを最初に把握しておこう",
              lecturePlay: false
            },
          ]
        },
        {
          lessonNo: 2,
          lessonTitle: "読書管理サービスでアプリケーション作りにチャレンジしよう",
          lessonPlay: false,
          lectures: [
            {
              lectureNo: 1,
              lectureTitle: "コースへようこそ",
              lecturePlay: false
            },
            {
              lectureNo: 2,
              lectureTitle: "コースのゴール",
              lecturePlay: false
            },
            {
              lectureNo: 3,
              lectureTitle: "コースを通じて作るものを最初に把握しておこう",
              lecturePlay: false
            },
          ]
        }
      ]
    }
  },
}
</script>
