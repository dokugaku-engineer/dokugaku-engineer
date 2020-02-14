<template>
  <div>
    <div class="header">
      <h3 class="header-title">コアカリキュラム</h3>
      <p class="header-text">実践的なスキルやエンジニアとしての考え方を身に付け、実務レベルで自走できる状態になり、エンジニアとして自走できる状態で就職する。基礎はおろか、発展的内容も一部は理解している。</p>
    </div>
    <div class="main">
      <div class="part">
        <div class="part-inner">
          <h3 class="part-subtitle">PART 1</h3>
          <h2 class="part-title">イントロダクション</h2>
          <p class="part-content">独学サーバーサイドのコースへようこそ！最初に、コースを受講するとできるようになることと、コースの進め方について学びます。</p>
          <div>
            <LectureList :lessonLectures="lesson1" />
          </div>
        </div>
      </div>
      <div class="part">
        <div class="part-inner">
          <h3 class="part-subtitle">PART 2</h3>
          <h2 class="part-title">プログラムの作り方</h2>
          <p class="part-content">プログラムの作り方を学びます。プログラミング初学者は、入門書などでプログラミングの文法は学んでいるものの、プログラムの作り方を学んでいないケースが多いです。プログラミングの文法とプログラムの作り方は別物で、プログラムの作り方を習得しないとプログラムでモノは作れるようになりません。個別の技術知識を学ぶ前に、まずはプログラムの作り方を、実際に作りながら学んでいきましょう。</p>
          <div>
            <LectureList :lessonLectures="lesson2" />
            <LectureList :lessonLectures="lesson2" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.header {
  background-color: #fafbfc;
  border-bottom: 1px solid $color-gray1;
  border-radius: .5rem;
  padding: 2rem 3rem;
}

@media screen and (min-width: 769px) {
  .header {
    padding: 2.8rem 5.6rem;
  }
}

.header-title {
  font-size: $font-size-xxxl;
  font-weight: 300;
  margin-bottom: 1.4rem;
}

.header-text {
  color: $color-gray3;
  font-size: $font-size-sm;
  max-width: 90rem;
}

.main {
  padding: 3rem 3rem 0;
}

@media screen and (min-width: 769px) {
  .main {
    padding: 4.2rem 5.6rem 0;
  }
}

.part {
  margin-bottom: 4.2rem;

  &:not(:last-child):after {
    content: "";
    border-bottom: 1px solid $color-gray1;
    display: block;
  }
}

.part-inner {
  margin-bottom: 3rem;
}

@media screen and (min-width: 769px) {
  .part-inner {
    margin-bottom: 4.2rem;
  }
}

.part-subtitle {
  color: $color-gray2;
  font-size: $font-size-sm;
  letter-spacing: 1.5px;
  margin-bottom: .7rem;
}

.part-title {
  color: $color-teal1;
  font-size: $font-size-lg;
  margin-bottom: 1.4rem;
}

.part-content {
  line-height: 2.8rem;
  margin-bottom: 1.4rem;
}
</style>

<script>
import LectureList from "@/components/partials/course/LectureList.vue"

export default {
  layout: "course",
  components: {
    LectureList,
  },
  data() {
    return {
      lesson1: {
        lessonNo: 1,
        lessonTitle: "コースについて",
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
      },
      lesson2: {
        lessonNo: 2,
        lessonTitle: "読書管理サービスを作ろう",
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
      },
    }
  },
}
</script>
