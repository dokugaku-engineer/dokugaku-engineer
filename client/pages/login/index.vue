<script>
import auth0Middleware from '~/middleware/auth0'

export default {
  layout: 'none',
  async fetch({ app }) {
    const options = {
      redirect_uri: `${process.env.ORIGIN}/course/serverside`,
      appState: {
        targetUrl: '/course/serverside'
      },
    }
    await app.$auth0.loginWithRedirect(options)
  }
}
</script>
