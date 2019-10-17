<template>
  <div>
    <div>ブログのナビゲーションバーをここに設置します</div>
    <nuxt />
  </div>
</template>

<script>
export default {
  head: {
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" }
    ],
    link: [
      {
        rel: "stylesheet",
        href: "https://fonts.googleapis.com/css?family=Roboto"
      }
    ]
  }
}
</script>
