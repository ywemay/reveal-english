# Reveal English

This is a project based on reveal.js. It stores some slides for English teaching.
It is based on [reveal.js](https://github.com/hakimel/reveal.js).

1. Install [Node.js](http://nodejs.org/) (4.0.0 or later)

1. Clone the reveal.js repository
   ```sh
   $ git clone https://github.com/ywemay/reaveal-english.git
   ```

1. Navigate to the reveal.js folder
   ```sh
   $ cd reveal-english
   ```

1. Install dependencies
   ```sh
   $ npm install
   ```

1. Serve the presentation and monitor source files for changes
   ```sh
   $ npm start
   ```

1. Open <http://localhost:8000> to view your presentation

   You can change the port by using `npm start -- --port=8001`.

### Folder Structure

- **css/** Core styles without which the project does not function
- **js/** Like above but for JavaScript
- **plugin/** Components that have been developed as extensions to reveal.js
- **lib/** All other third party assets (JavaScript, CSS, fonts)
- **slides/** Slides directory
- **assets/** Common slide's assets, videos, images, audios (not included in github repo)

## Instructions

Consult documentation at [reveal.js](https://github.com/hakimel/reveal.js).
