
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('summernote/dist/summernote-bs4');
require('jquery-ui/ui/widgets/draggable');
require('jquery-ui/ui/widgets/datepicker');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});


$(document).ready(function () {
    $('.nav').on('shown.bs.tab', 'a', function (e) {
        console.log(e.relatedTarget);
        if (e.relatedTarget) {
            $(e.relatedTarget).removeClass('active in');
        }
    });
});

$(document).ready(function() {
    $('.nav-tabs').on('shown.bs.tab', 'a', function(e) {
        console.log(e.relatedTarget);
        if (e.relatedTarget) {
            $(e.relatedTarget).removeClass('active');
        }
    });
});

$(document).ready(function () {
    $('.modal').on('show.bs.modal', function () {
        if ($(document).height() > $(window).height()) {
            // no-scroll
            $('body').addClass("modal-open-noscroll");
        }
        else {
            $('body').removeClass("modal-open-noscroll");
        }
    });
    $('.modal').on('hide.bs.modal', function () {
        $('body').removeClass("modal-open-noscroll");
    });
});

var myBookId = $(this).data('id');
$(".modal-body #bookId").val( myBookId );

$(document).ready(function () { //Dom Ready
    $('#stepsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var name = button.data('name') // Extract info from data-* attributes
        var text = button.data('text')
        var resource_name = button.data('resource_name')
        var resource_text = button.data('resource_text')
        var resource_rem = button.data('resource_rem')
        var route = button.data('route')

        var modal = $(this)
        document.getElementById('testH1').innerHTML=name;
        document.getElementById('name').innerHTML=name;
        document.getElementById('steptext').innerHTML=text;
        document.getElementById('resource_name').innerHTML=resource_name;
        document.getElementById('resource_text').innerHTML=resource_text;
        document.getElementById('resource_rem').innerHTML=resource_rem;
        document.getElementById('route').setAttribute("href",route);


    });
});



$(document).ready(function () { //Dom Ready
    $('.closefirstmodal').click(function () { //Close Button on Form Modal to trigger Warning Modal
        $('#Warning').modal('show').on('show.bs.modal', function () { //Show Warning Modal and use `show` event listener
            $('.confirmclosed').click(function () { //Warning Modal Confirm Close Button
                $('#Warning').modal('hide'); //Hide Warning Modal
                $('#stepsModal').modal('hide'); //Hide Form Modal
            });
        });
    });
});


var el = document.querySelector('.more');
var btn = el.querySelector('.more-btn');
var menu = el.querySelector('.more-menu');
var visible = false;

function showMenu(e) {
    e.preventDefault();
    if (!visible) {
        visible = true;
        el.classList.add('show-more-menu');
        menu.setAttribute('aria-hidden', false);
        document.addEventListener('mousedown', hideMenu, false);
    }
}

function hideMenu(e) {
    if (btn.contains(e.target)) {
        return;
    }
    if (visible) {
        visible = false;
        el.classList.remove('show-more-menu');
        menu.setAttribute('aria-hidden', true);
        document.removeEventListener('mousedown', hideMenu);
    }
}

btn.addEventListener('click', showMenu, false);

$(function() {
    $( ".swipeenabled" ).draggable();
});

