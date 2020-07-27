import MarkdownIt from 'markdown-it'
import Container from 'markdown-it-container'
import Sanitizer from 'markdown-it-sanitizer'
import Prism from 'prismjs'
import 'prismjs/components/prism-bash.min.js'
import 'prismjs/components/prism-docker.min.js'
import 'prismjs/components/prism-sql.min.js'
import 'prismjs/components/prism-php.min.js'
import 'prismjs/components/prism-markup-templating.js'

export default (context, inject) => {
  const md = new MarkdownIt({
    linkify: true,
    typography: true,
    breaks: true,
    highlight(str, lang) {
      let hl

      try {
        hl = Prism.highlight(str, Prism.languages[lang])
      } catch (error) {
        console.error(error)
        hl = md.utils.escapeHtml(str)
      }

      return `<pre class="language-${lang}"><code class="language-${lang}">${hl}</code></pre>`
    },
  })
  .use(Sanitizer)
  .use(Container, 'spoiler', {

    validate: function(params) {
      return params.trim().match(/^spoiler\s+(.*)$/);
    },

    render: function (tokens, idx) {
      var m = tokens[idx].info.trim().match(/^spoiler\s+(.*)$/);

      if (tokens[idx].nesting === 1) {
        // opening tag
        return '<details><summary>' + md.utils.escapeHtml(m[1]) + '</summary>\n';

      } else {
        // closing tag
        return '</details>\n';
      }
    }
  })

  const linkRender =
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

    return linkRender(tokens, idx, options, env, self)
  }

  // img タグに loading="lazy" 属性を付けて遅延ロードする
  const imageRender =
    md.renderer.rules.image ||
    function (tokens, idx, options, env, self) {
      return self.renderToken(tokens, idx, options)
    }

  md.renderer.rules.image = function (tokens, idx, options, env, self) {
    tokens[idx].attrPush(['loading', 'lazy'])
    return imageRender(tokens, idx, options, env, self)
  }

  inject('md', md)
}
