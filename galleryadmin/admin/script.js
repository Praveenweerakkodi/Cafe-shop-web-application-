const header = document.querySelector('header');

function fixedNavbar(){
    header.classList.toggle('scrolled',window.pageYOffset > 0)
}
fixedNavbar();
window.addEventListener('scroll',fixedNavbar);

let menu = document.querySelector('#menu-btn');

menu.addEventListener('click',function(){
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
})

let userBtn = document.querySelector('#user-btn');

userBtn.addEventListener('click', function(){
    let userBox = document.querySelector('.profile-detail');
    userBox.classList.toggle('active')
})

//search
document.getElementById('search-input').addEventListener('input', function() {
    const query = this.value;
    if (query.length >= 2) {
        fetchSuggestions(query);
    } else {
        document.getElementById('suggestions').style.display = 'none';
    }
});

function fetchSuggestions(query) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `fetch_suggestions.php?query=${query}`, true);
    xhr.onload = function() {
        if (this.status === 200) {
            const suggestions = JSON.parse(this.responseText);
            let suggestionsList = '';
            suggestions.forEach(suggestion => {
                suggestionsList += `<div onclick="selectSuggestion('${suggestion}')">${suggestion}</div>`;
            });
            document.getElementById('suggestions').innerHTML = suggestionsList;
            document.getElementById('suggestions').style.display = 'block';
        }
    };
    xhr.send();
}

function selectSuggestion(suggestion) {
    document.getElementById('search-input').value = suggestion;
    document.getElementById('suggestions').style.display = 'none';
    searchCuisine();
}

function searchCuisine() {
    const query = document.getElementById('search-input').value;
    window.location.href = `search_results.php?cuisine=${query}`;
}

/*------about us---------*/

function showWelcomePopup() {
    swal({
        title: "Welcome to Gallery Cafe!",
        text: "Enjoy a unique dining experience with us.",
        icon: "info",
        button: "Close",
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Optionally, add any JavaScript you need to trigger popups or animations
});

/*---------------------------------------------------------------------index banner---------------------------------------------------*/
document.addEventListener('DOMContentLoaded', function () {
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});

function checkLogin(action) {
    var isLoggedIn = document.getElementById('user_logged_in').value;
    if (isLoggedIn == '0') {
        swal('You need to login first as a User!');
    } else {
        swal('Logged in', 'Proceed with ' + action, 'success');
    }
}




/*----------------------------------------------------------------------Contact us ------------------------------------------------------*/

document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    fetch('contact_us.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.body.insertAdjacentHTML('beforeend', data);
        this.reset();
    })
    .catch(error => {
        swal({
            title: "Error!",
            text: "There was an error sending your message. Please try again later.",
            icon: "error",
            button: "OK",
        });
    });
});

/*----------------------------------------------footer----------------------------------------------------*/

document.addEventListener('DOMContentLoaded', function() {
    const footer = document.querySelector('.footer');
    footer.classList.add('animate-footer');
  });

  // Add a class for animations
  const style = document.createElement('style');
  style.innerHTML = `
    .footer.animate-footer {
      animation: fadeInUp 1s ease-in-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translate3d(0, 100%, 0);
      }
      to {
        opacity: 1;
        transform: none;
      }
    }
  `;
  document.head.appendChild(style);

