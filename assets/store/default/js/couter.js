// const counters = document.querySelectorAll('.auto_couter');
// const speed = 500;

// counters.forEach(counter => {
//     const animate = () => {
//         const value = +counter.getAttribute('akhi');
//         const data = +counter.innerText;

//         const time = value / speed;
//         if (data < value) {
//             counter.innerText = Math.ceil(data + time);
//             setTimeout(animate, 1);
//         } else {
//             counter.innerText = value;
//         }

//     }

//     animate();
// });

$(document).ready(function() {
    //  Khởi động bộ đếm khi phần tử ở trong khung nhìn
    function startCounter() {
        $('.auto_couter').each(function() {
            var $this = $(this);
            var countTo = $this.attr('data-count');
            $({ countNum: $this.text() }).animate({
                countNum: countTo
            }, {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            });
        });
    }

    // Kiểm tra người dùng lướt đến chưa
    function isScrolledIntoView(elem) {
        var docViewTop = $(window).scrollTop();
        var docViewBottom = docViewTop + $(window).height();
        var elemTop = $(elem).offset().top;
        return elemTop <= docViewBottom;
    }

    $(window).on('scroll', function() {
        if (isScrolledIntoView('.auto_couter') && !$('.auto_couter').hasClass('counted')) {
            $('.auto_couter').addClass('counted');
            startCounter();
        }
    });

    // Kích hoạt auto nếu bộ đếm đã có trang trình tải trang
    if (isScrolledIntoView('.auto_couter') && !$('.auto_couter').hasClass('counted')) {
        $('.auto_couter').addClass('counted');
        startCounter();
    }
});