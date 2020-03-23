/* 
要素の外側をクリックされたらイベントハンドラーを起動するプラグイン

使い方
1. 対象要素に v-click-outside="{ exlude: ['item'], handler="onHandler" }" を指定する
2. methodsに onHandler を定義する
3. 除外したい要素に ref="item" を追加する（buttonやi要素など）
*/

import Vue from 'vue'

let handleOutsideClick

Vue.directive('click-outside', {
  bind(el, binding, vnode) {
    handleOutsideClick = (e) => {
      e.stopPropagation()
      const {
        handler,
        exclude
      } = binding.value

      let clickedOnExcludedEl = false
      exclude.forEach(refName => {
        if (!clickedOnExcludedEl) {
          const excludedEl = vnode.context.$refs[refName]
          clickedOnExcludedEl = excludedEl.contains(e.target)
        }
      })

      if (!el.contains(e.target) && !clickedOnExcludedEl) {
        vnode.context[handler]()
      }
    }

    document.addEventListener('click', handleOutsideClick)
    document.addEventListener('touchstart', handleOutsideClick)
  },

  unbind() {
    document.removeEventListener('click', handleOutsideClick)
    document.removeEventListener('touchstart', handleOutsideClick)
  }
})