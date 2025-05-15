<?php
/*
Plugin Name: News Ticker (Multilingual)
Description: Displays a multilingual scrolling news ticker with start/end dates. Compatible with Polylang.
Version: 1.0
Author: Daiva Reinike
*/

if (!defined('ABSPATH')) exit;

// === News Ticker Shortcode with Multilingual Support ===

if (!function_exists('register_news_ticker_shortcode')) {
    add_action('admin_menu', function () {
        add_menu_page(
            'News Ticker',
            'News Ticker',
            'manage_options',
            'news-ticker',
            'render_news_ticker_admin',
            'dashicons-megaphone',
            30
        );
    });

    add_action('admin_init', function () {
        $languages = function_exists('pll_languages_list') ? pll_languages_list() : ['en'];
        foreach ($languages as $lang) {
            register_setting("news_ticker_group_{$lang}", "news_tickers_{$lang}");
        }
    });

    function render_news_ticker_admin() {
        $languages = function_exists('pll_languages_list') ? pll_languages_list() : ['en'];
        $selected_lang = $_GET['lang'] ?? $languages[0];
        $news_tickers = get_option("news_tickers_{$selected_lang}", []);
        ?>
        <div class="wrap">
            <h1>News Ticker (Language: <?php echo strtoupper($selected_lang); ?>)</h1>
            <form method="get" action="">
                <input type="hidden" name="page" value="news-ticker" />
                <label for="lang">Select language: </label>
                <select name="lang" id="lang" onchange="this.form.submit()">
                    <?php foreach ($languages as $lang): ?>
                        <option value="<?php echo esc_attr($lang); ?>" <?php selected($selected_lang, $lang); ?>>
                            <?php echo esc_html(strtoupper($lang)); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
            <form method="post" action="options.php">
                <?php settings_fields("news_ticker_group_{$selected_lang}"); ?>
                <table class="form-table">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <tr>
                            <th scope="row">Ticker <?php echo $i + 1; ?> Text</th>
                            <td>
                                <textarea name="news_tickers_<?php echo $selected_lang; ?>[<?php echo $i; ?>][text]" style="width: 100%; height: 60px;"><?php echo esc_textarea($news_tickers[$i]['text'] ?? ''); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Start Date</th>
                            <td>
                                <input type="date" name="news_tickers_<?php echo $selected_lang; ?>[<?php echo $i; ?>][start]" value="<?php echo esc_attr($news_tickers[$i]['start'] ?? ''); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">End Date</th>
                            <td>
                                <input type="date" name="news_tickers_<?php echo $selected_lang; ?>[<?php echo $i; ?>][end]" value="<?php echo esc_attr($news_tickers[$i]['end'] ?? ''); ?>" />
                            </td>
                        </tr>
                        <tr><td colspan="2"><hr></td></tr>
                    <?php endfor; ?>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    function get_ticker_language_from_html() {
        if (function_exists('pll_get_current_language')) {
            $lang = pll_get_current_language();
            if (!empty($lang)) return $lang;
        }
        $locale = get_locale();
        return substr($locale, 0, 2);
    }

    add_shortcode('news_ticker', function () {
        $lang = get_ticker_language_from_html();
        $news_tickers = get_option("news_tickers_{$lang}", []);
        $today = strtotime(date('Y-m-d'));

        $active_texts = [];

        foreach ($news_tickers as $ticker) {
            $text = trim($ticker['text'] ?? '');
            $start = trim($ticker['start'] ?? '');
            $end = trim($ticker['end'] ?? '');

            if (empty($text)) continue;

            $start_ok = true;
            $end_ok = true;

            if (!empty($start)) {
                $start_ts = strtotime($start);
                if ($start_ts === false || $start_ts > $today) {
                    $start_ok = false;
                }
            }

            if (!empty($end)) {
                $end_ts = strtotime($end);
                if ($end_ts === false || $end_ts < $today) {
                    $end_ok = false;
                }
            }

            if ($start_ok && $end_ok) {
                $active_texts[] = $ticker;
            }
        }

        if (empty($active_texts)) {
            return '<div class="news-ticker"><em>No current news.</em></div>';
        }

        $scroll_text = '';
        foreach ($active_texts as $ticker) {
            $scroll_text .= $ticker['text'] . ' <img src="' . plugin_dir_url(__FILE__) . 'leaf.png" class="ticker-leaf" alt="leaf icon" /> ';
        }

        // Duplicate for smooth scrolling
        $scroll_text .= $scroll_text;

        return '
        <div class="news-ticker-wrapper">
            <div class="news-ticker-text">
                ' . $scroll_text . '
            </div>
        </div>';
    });
}

// Enqueue external CSS file (optional)
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'news-ticker-style',
        plugin_dir_url(__FILE__) . 'css/ticker-style.css',
        [],
        '1.0'
    );
});
