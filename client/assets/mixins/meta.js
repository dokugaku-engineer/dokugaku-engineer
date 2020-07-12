export default {
  data() {
    return {
      meta: {
        title: null,
        baseTitle: ' - 独学エンジニア',
        baseUrl: process.env.ORIGIN || 'http://localhost:3333',
        description: '',
        type: 'website',
        image: ''
      }
    }
  },
  head () {
    const head = { meta: [] }

    // タイトル
    if (this.meta.title) {
      const title = `${this.meta.title}${this.meta.baseTitle}`
      head.title = title
      head.meta.push({ hid: 'og:title', property: 'og:title', content: title })
    }

    // ディスクリプション
    if (this.meta.description) {
      head.meta.push({ hid: 'description', name: 'description', content: this.meta.description })
      head.meta.push({ hid: 'og:description', property: 'og:description', content: this.meta.description })
    }

    // ページタイプ
    if (this.meta.type) {
      head.meta.push({ hid: 'og:type', property: 'og:type', content: this.meta.type })
    }

    // ページURL
    const url = `${this.meta.baseUrl}${this.$router.history.base}${this.$route.path}`
    head.meta.push({ hid: 'og:url', property: 'og:url', content: url })

    // OGP画像URL
    if (this.meta.image) {
      const imageUrl = `${process.env.ORIGIN || 'http://localhost:3333'}${this.meta.image}`
      head.meta.push({ hid: 'og:image', property: 'og:image', content: imageUrl })
    }

    return head
  }
}
