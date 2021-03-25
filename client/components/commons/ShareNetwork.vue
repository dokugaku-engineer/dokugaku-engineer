<template>
  <div id="share-network-list">
    <ShareNetwork
      v-for="network in networks"
      :key="network.network"
      :network="network.network"
      :style="{ backgroundColor: network.color }"
      :url="sharing.url"
      :title="sharing.title"
      :description="sharing.description"
      :hashtags="sharing.hashtags"
      :twitter-user="sharing.twitterUser"
    >
      <i :class="network.icon" />
      <span>{{ network.name }}</span>
    </ShareNetwork>
  </div>
</template>

<style lang="scss" scoped>
#share-network-list {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  max-width: 1000px;
  margin: auto;
  margin-top: 3rem;
}

a[class^='share-network-'] {
  flex: none;
  color: #ffffff;
  background-color: #333;
  border-radius: 3px;
  overflow: hidden;
  display: flex;
  flex-direction: row;
  align-content: center;
  align-items: center;
  cursor: pointer;
  margin: 0 10px 10px 0;
}

a[class^='share-network-'] .fah {
  background-color: rgba(0, 0, 0, 0.2);
  flex: 0 1 auto;
  padding: 10px;
  vertical-align: middle;
}

a[class^='share-network-'] span {
  padding: 0 10px;
  flex: 1 1 0%;
  font-weight: 500;
}

a.share-network-twitter {
  background-color: #1da1f2;
}
</style>

<script>
export default {
  data() {
    return {
      sharing: {
        url: 'https://dokugaku-engineer.com/',
        title: '独学エンジニア | 大丈夫、独学でもエンジニアになれる',
        description:
          '「技術をちゃんと理解して、実務で自走できるエンジニアになる」ための本格プログラミング講座です。基礎から実務で必要なスキルを網羅。未知の課題に出会っても自分で解決できる実践的スキルが身につきます。',
      },
      networks: [
        {
          network: 'facebook',
          name: 'Facebook',
          icon: 'fab fah fa-lg fa-facebook-f',
          color: '#1877f2',
        },
        {
          network: 'twitter',
          name: 'Twitter',
          icon: 'fab fah fa-lg fa-twitter',
          color: '#1da1f2',
        },
      ],
    }
  },
}
</script>
