document.addEventListener('DOMContentLoaded', function() {
    var links = document.querySelectorAll('.nav_bar div');
    links.forEach(function(link) {
        link.addEventListener('click', function() {
            var target = link.getAttribute('data-target');
            var contents = document.querySelectorAll('.container');
            contents.forEach(function(content) {
                content.classList.remove('active');
            });
            document.getElementById(target).classList.add('active');
        });
    });
});

function nav(val) {
    
    var active = document.getElementById(val);
    var done = document.getElementById(val);

    if(val === 'profile_nav') {
        active.style.fontWeight = "bolder";
        active.style.color = "#00004C";
        done = document.getElementById('parent_nav');
        done.style.fontWeight = "normal";
        done.style.color  = "black";
        done = document.getElementById('education_nav');
        done.style.fontWeight = "normal";
        done.style.color  = "black";
    } else if(val === 'parent_nav') {
        active.style.fontWeight = "bolder";
        active.style.color = "#00004C";
        done = document.getElementById('profile_nav');
        done.style.fontWeight = "normal";
        done.style.color  = "black";
        done = document.getElementById('education_nav');
        done.style.fontWeight = "normal";
        done.style.color  = "black";
    } else if(val === 'education_nav') {
        active.style.fontWeight = "bolder";
        active.style.color = "#00004C";
        done = document.getElementById('profile_nav');
        done.style.fontWeight = "normal";
        done.style.color  = "black";
        done = document.getElementById('parent_nav');
        done.style.fontWeight = "normal";
        done.style.color  = "black";
    }

}