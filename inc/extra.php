<?php

// Post social share options
function appland_spanTag($string, $tagSign = '|') {
    if(strpos($string, $tagSign) !== false) {
        $firstSign = strpos($string, $tagSign);
        $lastSign = strpos($string, $tagSign, $firstSign + 1);
        $strArray = str_split($string);
        $replaceSigns = array($firstSign => '<span>', $lastSign => '</span>');
        $replaceSigns = array_replace($strArray, $replaceSigns);
        echo implode($replaceSigns);
    }else {
        echo $string;
    }
}

// Category array
function Appland_cat_array() {
    $cats = get_categories();
    $cat_array = array();
    $cat_array['all'] = esc_html__('All', 'appland-core');
    foreach ($cats as $cat) {
        $cat_array[$cat->slug] = $cat->name;
    }
    return array_flip($cat_array);
}


// Social Share
function Appland_social_share() { ?>
    <div class="share_title"> <?php esc_html_e('Share Post: ', 'appland'); ?> </div>
    <div class="icon">
        <a href="https://facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com/intent/tweet?text=<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
        <a href="https://www.pinterest.com/pin/create/button/?url=<?php the_permalink() ?>"><i class="fa fa-pinterest-p"></i></a>
        <a href="https://plus.google.com/share?url=<?php the_permalink() ?>"><i class="fa fa-google-plus"></i></a>
    </div>
    <?php
}


// Font size attribute output for Shortcode
function Appland_shortcode_style($css_property, $atts, $param='', $echo = 1) {
    if($echo == 1) {
        echo !empty($atts[$param]) ? $css_property . ': ' . $atts[$param] . ';' : '';
    }else {
        return !empty($atts[$param]) ? $css_property . ': ' . $atts[$param] . ';' : '';
    }
}

function Appland_FontSize($atts, $param='') {
    return !empty($atts[$param]) ? 'font-size: '.$atts[$param].';' : '';
}

// Font size attribute output for Shortcode
function Appland_BgColor($atts, $param='') {
    echo !empty($atts[$param]) ? 'background-color: '.$atts[$param].';' : '';
}

function Appland_FontWeight($atts, $param='') {
    echo !empty($atts[$param]) ? 'font-weight: '.$atts[$param].';' : '';
}


function Appland_Padding($atts, $param='') {
    echo !empty($atts[$param]) ? 'padding: '.$atts[$param].';' : '';
}

function Appland_Margin($atts, $param='') {
    echo !empty($atts[$param]) ? 'margin: '.$atts[$param].';' : '';
}

// Font size attribute output for Shortcode
function Appland_get_image_src($atts, $param='') {
    $image_id = !empty($atts[$param]) ? wp_get_attachment_image_src($atts[$param], 'full') : '';
    return isset($image_id[0]) ? $image_id[0] : '';
}

// Get slug of words
function Appland_get_words_slug($text) {
    return str_replace(' ', '-', strtolower($text));
}

//
if(isset($_POST['contact_submit'])) {
    $to = !empty($opt['mail_to']) ? $opt['mail_to'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $sub = isset($_POST['sub']) ? $_POST['sub'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';
    $body = "<b>".esc_html__("Name: ", "appland-core")."</b>".$name."<br>
            <b>".esc_html__("Phone: ", "appland-core")."</b>".$phone."<br>
            <b>".esc_html__("Email: ", "appland-core")."</b>".$email."<br>
            <b>".esc_html__("Subject: ", "appland-core")."</b>".$sub."<br>
            <b>".esc_html__("Message: ", "appland-core")."</b>".$message."<br>";
    $headers = array("Content-Type: text/html; charset=UTF-8");
    wp_mail($to, $name , $email ,$phone ,$sub, $body, $headers);
    if (@wp_mail($to, $name , $email ,$phone ,$sub, $body, $headers)) {
        echo "<br> <br>" . esc_html__("Your message has sent successfully", "faster-core");
    } else {
        echo "<br> <br>" . esc_html__("An error occurred. Please fill the form again and submit.", "faster-core");
    }
}
