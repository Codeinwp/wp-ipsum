<?php
/*
Plugin Name: WP Ipsum Generator
Plugin URI: https://codeinwp.com
Description: A simple plugin that adds a WordPress Lorem Ipsum generator to your site.
Version: 1.0
Author: CodeinWP
Author URI: https://codeinwp.com
License: GPLv2 or later
*/

function generate_ipsum_form() {
    ob_start();
    ?>
    <style>
        .generator{
        max-width:700px;
        margin: 0 auto;
        padding:30px 0;
        }
        .wi-form {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom:20px;
        }
        .paraAmountNum{
        display: flex;
        justify-content: center;
        align-items: center;
        }
        .wi-btn {
        text-transform: uppercase;
        background: transparent;
        color: #222;
        letter-spacing: 0.1rem;
        display: inline-block;
        font-weight: 700;
        transition: all 0.3s linear;
        border: 2px solid #222;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        border-radius: 0.25rem;
        font-size: 1rem;
        padding: 0.375rem 0.75rem;
        }
        .wi-btn:hover {
        color: #fff;
        background:#063251;
        }
        #wi-output {
        margin: 50px auto;
        padding:20px 20px 0 20px;
        border: 1px solid #eaeaea;
        background: #fff;
        }
        #wi-ooutput p{
        margin-bottom:20px;
        }
        }
    </style>

    <div class="wi-generator">
        <h2>WordPress Ipsum Generator</h1>
        <p class="wi-form">
        <label for="numParagraphs">Number of paragraphs:</label>
        <input type="number" id="numParagraphs" min="1" max="50" value="5">
        </p>
        <p class="wi-form">
        <label for="numWords">Number of words per paragraph:</label>
        <input type="number" id="numWords" min="1" max="100" value="30">
        </p>
        <center><button class="wi-btn" onclick="generateIpsum()">Generate Ipsum</button></center>
        <div id="wi-output"></div>
    </div>

    <script>
        let words=["WordPress","wp","blog","website","gutenberg","plugin","theme","post","page","option","camp","category","tag","fields","widget","dashboard","admin","panel","editor","php","html","css","javascript","mysql","database","seo","permalinks","shortcode","comments","pingbacks","trackbacks","media","library","featured","meta box","header","footer","sidebar","template","child","woocommerce","jetpack","elementor","yoast","akismet","cf7","wpml","multisite","hosting","cdn","cache","security","ssl","backup","migration","updates","user","contributor","admin","query","repository", "directory","contributor","patterns","FSE","author","editor","subscriber","administrator","api","rss","feed","WYSIWYG","accessibility","breadcrumbs","gravatar","sticky","permalink","pagination","responsive","password","private","draft","schedule","revision","autosave","404","htaccess","robots","sitemap","dns","domain","blacklist","whitelist","FTP","ssh","cpanel","plesk","ssl","spam","uptime","bandwidth","GPL","divi","neve","avada","astra","beaver","thrive","revolution","envato","bbpress","buddypress","ACF","cache","wordfence","redirection","rocket","regenerate","thumbnails","maintenance","construction","cornerstone","ninja","wpforms","forms","lazy","w3","tinymce","classic","visual","text","blocks","block","carousel","image","gallery","accordion","tabs","button","CTA","testimonials","icons","and","as","on","for","in","of","nor","if","or","so","yet","as","at","by","for","in","of","off","on","per","to","up","via","hosting", "localhost", "database","codeinwp","themeisle"];

        function getRandomWord() {
            return words[Math.floor(Math.random() * words.length)];
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function generateSentence(minWords, maxWords) {
            let numWords = Math.floor(Math.random() * (maxWords - minWords + 1)) + minWords;
            let sentence = capitalizeFirstLetter(getRandomWord());

            for (let i = 1; i < numWords; i++) {
                sentence += " " + getRandomWord();
            }

            return sentence + ".";
        }

        function generateParagraph(numWords) {
            let paragraph = "";
            while (paragraph.split(' ').length < numWords) {
                paragraph += generateSentence(5, 12) + " ";
                if (paragraph.split(' ').length > numWords) {
                    let words = paragraph.split(' ');
                    words.splice(numWords);
                    paragraph = words.join(' ');
                    if (paragraph.slice(-1) !== ".") {
                        paragraph += ".";
                    }
                }
            }
            return paragraph;
        }

        function generateIpsum() {
            let numParagraphs = document.getElementById("numParagraphs").value;
            let numWords = document.getElementById("numWords").value;
            let output = "";

            for (let i = 0; i < numParagraphs; i++) {
                output += "<p>" + generateParagraph(numWords) + "</p>";
            }

            document.getElementById("wi-output").innerHTML = output;
        }
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('wp_ipsum', 'generate_ipsum_form');
?>