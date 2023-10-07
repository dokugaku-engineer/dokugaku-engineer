<template>
  <div class="container">
    <div class="sidebar">
      <h1 class="sidebar-header">管理画面</h1>
      <div>
        <ul class="sidebar-content">
          <li>
            <nuxt-link to="/admin/posts">
              <i class="far fa-pencil fa-lg" />
              ブログ記事
            </nuxt-link>
          </li>
          <li>
            <nuxt-link to="/admin/categories">
              <i class="fas fa-list fa-lg" />
              カテゴリー
            </nuxt-link>
          </li>
        </ul>
      </div>
    </div>
    <div class="content">
      <nuxt />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.container {
  display: flex;
  min-height: 100vh;
}

.sidebar {
  padding: 20px;
  width: 200px;
}

.sidebar-header {
  font-weight: 600;
  margin-bottom: 40px;
  padding-left: 10px;
}

.sidebar-content {
  font-weight: 700;

  li {
    margin-bottom: 5px;

    a {
      display: block;
      padding: 10px 0 10px 10px;

      &:hover {
        background-color: $color-teal3;
      }
    }
  }

  i {
    color: $color-teal1;
    padding-right: 10px;
  }
}

.content {
  background-color: $color-white2;
  padding: 20px 50px;
  width: calc(100% - 200px);
}
</style>
