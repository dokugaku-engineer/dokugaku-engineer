import MarkdownIt from 'markdown-it'
import sanitizer from 'markdown-it-sanitizer'
import Prism from 'prismjs'
import 'prismjs/components/prism-bash.min.js'
import 'prismjs/components/prism-docker.min.js'
import 'prismjs/components/prism-sql.min.js'
import 'prismjs/components/prism-php.min.js'
import 'prismjs/components/prism-markup-templating.js'

export default (context, inject) => {
  const md = new MarkdownIt({
    html: true,
    linkify: true,
    typography: true,
    breaks: true,
    highlight (str, lang) {
      let hl

      try {
        hl = Prism.highlight(str, Prism.languages[lang])
      } catch (error) {
        console.error(error)
        hl = md.utils.escapeHtml(str)
      }

      return `<pre class="language-${lang}"><code class="language-${lang}">${hl}</code></pre>`
    }
  })
  .use(sanitizer)

  const defaultRender =
    md.renderer.rules.link_open ||
    function (tokens, idx, options, env, self) {
      return self.renderToken(tokens, idx, options)
    }

  // markdown-it で生成される <a> タグに target="_blank" rel="noopener" 属性を付ける
  md.renderer.rules.link_open = function (tokens, idx, options, env, self) {
    const targetIndex = tokens[idx].attrIndex('target')
    if (targetIndex < 0) {
      tokens[idx].attrPush(['target', '_blank'])
    } else {
      tokens[idx].attrs[targetIndex][1] = '_blank'
    }

    const relIndex = tokens[idx].attrIndex('rel')
    if (relIndex < 0) {
      tokens[idx].attrPush(['rel', 'noopener'])
    } else {
      tokens[idx].attrs[relIndex][1] = 'noopener'
    }

    return defaultRender(tokens, idx, options, env, self)
  }

  inject('md', md)
}
