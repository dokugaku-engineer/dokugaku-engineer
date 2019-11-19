<template>
  <main class="box">
    <div class="box-header">
      <h4>{{ title }}</h4>
      <link-button v-if="to" :to="to" class="btn-red1">
        {{ buttonText }}
      </link-button>
    </div>
    <div class="box-content">
      <slot name="content" />
    </div>
  </main>
</template>

<style lang="scss" scoped>
.box {
  background-color: $color-white1;
  padding: 20px;
}

.box-header {
  align-items: center;
  border-bottom: solid 1px $color-gray1;
  display: flex;
  padding-bottom: 20px;
  position: relative;

  h4 {
    display: inline-block;
    font-weight: 700;
  }

  a {
    position: absolute;
    right: 10px;
  }
}

.box-content {
  padding: 40px 30px 20px;
}
</style>

<script>
import LinkButton from "@/components/commons/LinkButton.vue"

export default {
  components: {
    LinkButton
  },
  props: {
    title: {
      type: String,
      default: ""
    },
    to: {
      type: String,
      default: ""
    },
    buttonText: {
      type: String,
      default: ""
    }
  }
}
</script>
