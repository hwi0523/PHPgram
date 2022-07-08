if(feedObj){
    const url = new URL(location.href);
    feedObj.iuser = parseInt(url.searchParams.get('iuser'));
    feedObj.getFeedUrl = '/user/feed';
    feedObj.getFeedList();
}

(function() {
    const lData = document.querySelector('#lData');
    const btnFollow = document.querySelector('#btnFollow');
    const spanfollow = document.querySelector('#spanfollow');
    const btnDelCurrentProfilePic = document.querySelector('#btnDelCurrentProfilePic');
    const btnProfileImgModalClose = document.querySelector('#btnProfileImgModalClose');
    const modalProfileImg = document.querySelector('#profileImgModal');
    const FrmProfileImg = modalProfileImg.querySelector('form');
    let follownum = parseInt(spanfollow.innerText);
    if(btnFollow) {
        btnFollow.addEventListener('click', function() {
            const param = {
                toiuser: parseInt(lData.dataset.toiuser)
            };
            console.log(param);
            const follow = btnFollow.dataset.follow;
            console.log('follow : ' + follow);
            const followUrl = '/user/follow';
            switch(follow) {
                case '1': //팔로우 취소
                    fetch(followUrl + encodeQueryString(param), {method: 'DELETE'})
                    .then(res => res.json())
                    .then(res => {                        
                        if(res.result) {
                            btnFollow.dataset.follow = '0';
                            btnFollow.classList.remove('btn-outline-secondary');
                            btnFollow.classList.add('btn-primary');
                            if(btnFollow.dataset.youme === '1') {
                                btnFollow.innerText = '맞팔로우 하기';
                            } else {
                                btnFollow.innerText = '팔로우';
                            } 
                            follownum = follownum-1;
                            spanfollow.innerText = follownum;                        
                        }
                    });
                    break;
                case '0': //팔로우 등록
                    fetch(followUrl, {
                        method: 'POST',
                        body: JSON.stringify(param)
                    })
                    .then(res => res.json())
                    .then(res => {
                        if(res.result) {
                            btnFollow.dataset.follow = '1';
                            btnFollow.classList.remove('btn-primary');
                            btnFollow.classList.add('btn-outline-secondary');
                            btnFollow.innerText = '팔로우 취소';
                            follownum = follownum+1;
                            spanfollow.innerText = follownum;
                        }
                    });
                    break;
            }
        });
    }
    if(btnDelCurrentProfilePic){
        btnDelCurrentProfilePic.addEventListener('click', e=>{
            fetch('/user/profile',{method: 'DELETE'})
            .then(res=> res.json())
            .then(res=>{
                if(res.result){
                    console.log(res.result);
                    const profileImgList = document.querySelectorAll('.profileimg');
                    profileImgList.forEach(item=>{
                        item.src='/static/img/profile/Te.png';
                    })
                }
                btnProfileImgModalClose.click();
            });
        });
    }

    if(btnInsProfilePic){
        btnInsProfilePic.addEventListener('click', e => {
                FrmProfileImg.imgs.click();
        });

        FrmProfileImg.imgs.addEventListener('change', e => {
            if(e.target.files.length){
                const fData = new FormData();
                fData.append('profileImg', e.target.files[0]);
                fetch('/user/profile', {
                    method: 'post',
                    body: fData
                })
                .then(res => res.json())
                .then(res => {
                    if(res.result){
                        const gData = document.querySelector('#gData');
                        const profileImgList = document.querySelectorAll('.profileimg');
                        profileImgList.forEach(item => {
                            item.src = `/static/img/profile/${gData.dataset.loginiuser}/${res.fileNm}`;
                        });
                        btnProfileImgModalClose.click();
                    }
                });
            }
        });
    }
})();