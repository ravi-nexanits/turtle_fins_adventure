<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here
$secondColor = "#ff8"; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}


function checkhexcolor2($secondColor){
    return preg_match('/^#[a-f0-9]{6}$/i', $secondColor);
}

if (isset($_GET['secondColor']) AND $_GET['secondColor'] != '') {
    $secondColor = "#" . $_GET['secondColor'];
}

if (!$secondColor OR !checkhexcolor2($secondColor)) {
    $secondColor = "#336699";
}
?>

.preloader .icon {
    text-shadow: 0 0 10px <?= $color ?>e6;
}
.custom--accordion-two .accordion-button:not(.collapsed), .preloader .icon, .about-item__icon i, .overview-item__number, .inlne-menu li a:hover, .package-sidebar-list li i, .contact-item i, .contact-item p a:hover {
    color: <?= $color ?>;
}
body::-webkit-scrollbar-thumb, .preloader .rounded-circle::after, .find-tabs .nav-item .nav-link.active, .location-slider .slick-arrow:hover, .trip-card__price, .trip-slider .slick-dots li.slick-active button, .subscribe-form button, .tour-plan-block .title span, .package-sidebar-widget .thumb .price, .single-review .progress .progress-bar {
    background-color: <?= $color ?>;
}

.header .main-menu li a:hover, .header .main-menu li a:focus {
    color: <?= $color ?>;
}

.btn--base {
    background-color: <?= $color ?>;
}
.btn--base:hover {
    background-color: <?= $color ?>;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: <?= $color ?>;
}

.form--control:focus {
    border-color: <?= $color ?> !important;
}

a:hover {
    color: <?= $color ?>;
}

.trip-card__price {
    box-shadow: 0 5px 15px 2px <?= $color ?>66;
}

.post-card__meta li a:hover {
    color: <?= $color ?>;
}

.text--btn {
    color: <?= $color ?>;
}

.footer__bottom::before {
    background-color: <?= $secondColor ?>;
}

.form--control:focus {
    box-shadow: 0 0 5px <?= $color ?>59;
}

.custom--checkbox input:checked ~ label::before {
    color: <?= $color ?>;
}

.page-breadcrumb li:first-child::before {
    color: <?= $color ?>;
}

.custom--nav-tabs .nav-item .nav-link.active {
    background-color: <?= $color ?>;
}

.text--base {
    color: <?= $color ?> !important;
}

.form--control {
    border: 1px solid <?= $color ?>;
}

.header .main-menu li .sub-menu li a:hover {
    color: <?= $color ?>;
}

.header .main-menu li.menu_has_children:hover > a::before {
    color: <?= $color ?>;
}

.profile-thumb .avatar-edit label {
    background-color: <?= $color ?>;
}

.page-breadcrumb li a:hover {
    color: <?= $color ?>;
}

.custom--file-upload ~ label {
    background-color: <?= $color ?>;
}

.pagination .page-item.active .page-link {
    background-color: <?= $color ?>;
}
.pagination .page-item .page-link {
    border: 1px solid <?= $color ?>40;
}
.pagination .page-item .page-link:hover {
    background-color: <?= $color ?>;
    border-color: <?= $color ?>;
}
.header .main-menu li .sub-menu li a:hover {
    background-color: <?= $color ?>0d;
}
.form-check-input:checked, .action-widget__title.no-icon::after {
    background: <?= $color ?>;
    border-color: <?= $color ?>;
}
.cmn-list li::before, .d-widget__icon i  {
    color: <?= $color?>
}
.phone-number li a i {
    color: <?= $color?>
}

element.style {
}
.social-icons li a {
    color: <?= $color?>
}