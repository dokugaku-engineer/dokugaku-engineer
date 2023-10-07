<template>
  <div class="wrap">
    <logged-in-header ref="header" :title="title" />
    <div class="main" :style="marginTop">
      <div class="main-inner">
        <nav class="sidebar">
          <h4 class="sidebar-header-text">設定</h4>
          <ul>
            <li>
              <nuxt-link
                to="/settings/profile"
                :class="sidebarLinkClass('プロフィール')"
              >
                プロフィール
              </nuxt-link>
            </li>
            <li>
              <nuxt-link
                to="/settings/password"
                :class="sidebarLinkClass('パスワード')"
              >
                パスワード
              </nuxt-link>
            </li>
            <li>
              <nuxt-link
                to="/settings/billing"
                :class="sidebarLinkClass('お支払い情報')"
              >
                お支払い情報
              </nuxt-link>
            </li>
          </ul>
        </nav>
        <div class="content">
          <nuxt />
        </div>
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

.main {
  background-color: $color-white2;
  display: flex;
  flex-grow: 1;
  height: 100%;
  padding: 1.6rem 1rem;
}

@media screen and (min-width: 769px) {
  .main {
    padding: 3rem 5rem;
  }
}

.main-inner {
  display: flex;
  flex-grow: 1;
  margin: 0 auto;
}

@media screen and (min-width: 769px) {
  .main-inner {
    max-width: 102.4rem;
    width: 90%;
  }
}

.sidebar {
  display: none;
}

@media screen and (min-width: 769px) {
  .sidebar {
    display: block;
    font-size: $font-size-sm;
    font-weight: 700;
    margin-right: 1.5rem;
    overflow: auto;
    padding: 0 1.4rem;
    transition: all 0.2s;
    width: 25%;
  }

  .sidebar-header-text {
    font-size: $font-size-base;
    padding: 0 0 1.2rem 1.6rem;
  }

  .sidebar-link {
    border-radius: 0.2rem;
    display: block;
    padding: 1.1rem 1.5rem;
  }

  .sidebar-link-focus {
    background: $color-blue;
    color: $color-white1;
  }
}

.content {
  background-color: $color-white1;
  border-radius: 0.5rem;
  box-shadow: 0 1px 20px 0 $color-gray-shadow;
  flex: 1;
}

@media screen and (min-width: 769px) {
  .content {
    margin: 0;
  }
}

.footer_wrap {
  margin-top: auto;
}
</style>

<script>
import LoggedInHeader from '@/components/layouts/LoggedInHeader.vue'
import NuiFooter from '@/components/layouts/Footer.vue'
import auth0Middleware from '@/middleware/auth0'
import { mapState, mapGetters } from 'vuex'
import debounce from 'lodash/debounce'

export default {
  components: {
    LoggedInHeader,
    NuiFooter,
  },
  data() {
    return {
      headerHeight: 0,
    }
  },
  middleware: auth0Middleware.protect(),
  computed: {
    ...mapState(['title']),
    ...mapGetters('auth0', ['userId']),
    marginTop() {
      return `margin-top: ${this.headerHeight}px;`
    },
  },
  mounted() {
    this.headerHeight = this.$refs.header.$el.clientHeight
    window.addEventListener('resize', this.handleResize)
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.handleResize)
  },
  methods: {
    sidebarLinkClass(name) {
      if (this.title == name) {
        return 'sidebar-link sidebar-link-focus'
      } else {
        return 'sidebar-link'
      }
    },
    handleResize: debounce(function () {
      this.headerHeight = this.$refs.header.$el.clientHeight
    }, 300),
    async getOptions() {
      const token = await this.$auth0.getTokenSilently()
      return {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      }
    },
    async clickBilling(e) {
      e.preventDefault()
      const options = await this.getOptions()
      this.$axios
        .$get('/subscriptions/customer_portal', options)
        .then((response) => {
          window.location.assign(response.url)
        })
        .catch((error) => {
          console.error('Error:', error)
        })
    },
  },
}
</script>
