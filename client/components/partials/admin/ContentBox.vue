<template>
  <main class="box">
    <div class="box-header">
      <slot name="header" />
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
  border-bottom: solid 1px $color-gray1;
  padding-bottom: 20px;
}

.box-content {
  padding: 40px 30px 20px;
}
</style>
