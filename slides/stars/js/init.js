// More info about config & dependencies:
// - https://github.com/hakimel/reveal.js#configuration
// - https://github.com/hakimel/reveal.js#dependencies
Reveal.initialize({
	hash: true,
  keyboard: {
    65: null, // a
    68: null, // d
    83: null, // s
    74: null, // j
    75: null, // k
    76: null, // l
    32: null, //
  },
	dependencies: [
		{ src: '/plugin/markdown/marked.js' },
		{ src: '/plugin/markdown/markdown.js' },
		{ src: '/plugin/highlight/highlight.js' },
		{ src: '/plugin/notes/notes.js', async: true }
	]
});
