function progressBar(val) {

    // Access parent window's DOM
    parentDocument = window.parent.document;
        if(val==1) {
            inprogress = parentDocument.getElementById('academic-info');
            done = parentDocument.getElementById('student-profile');
            done1();
            inprogress1();   
        } else if(val==2) {
            inprogress = parentDocument.getElementById('parent-info');
            done = parentDocument.getElementById('academic-info');
            done1();
            inprogress1();
        } else if(val==3) {
            inprogress = parentDocument.getElementById('edu-bg');
            done = parentDocument.getElementById('parent-info');
            done1();
            inprogress1();
        } else if(val==4) {
            inprogress = parentDocument.getElementById('requirements');
            done = parentDocument.getElementById('edu-bg');
            done1();
            inprogress1();   
        }
}

function inprogress1() {
inprogress.style.borderLeftColor = '#00004C';
inprogress.style.fontSize = '18px';
inprogress.style.color = 'black';
inprogress.style.fontWeight='bold';
done1();
}

function done1() {
done.style.color = 'gray';
done.style.fontWeight='lighter';
done.style.fontSize = '18px';
}