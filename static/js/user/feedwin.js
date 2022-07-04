function getFeedList() {
    if(!feedObj) { return; }
    const Url =new URL(location.href);

    feedObj.showLoading();            
    const param = {
        page: feedObj.currentPage++,
        iuser: Url.searchParams.get('iuser')
    }
    fetch('/user/feed' + encodeQueryString(param))
    .then(res => res.json())
    .then(list => {                
        feedObj.makeFeedList(list);                
    })
    .catch(e => {
        console.error(e);
        feedObj.hideLoading();
    });
}
getFeedList();



(function(){
    const btnFollow =document.querySelector('#btnFollow');
    if(btnFollow){
        btnFollow.addEventListener('click', function(){
           const param={
                toiuser:parseInt(gData.dataset.toiuser)
           };
            const follow = btnFollow.dataset.follow;
            console.log(follow);
            const followUrl = '/user/follow';
            switch(follow){
                case '1':   //팔로우 취소
                    fetch(followUrl + encodeQueryString(param),{method:'DELETE'})
                    .then(res=>res.json())
                    .then(res=>{
                        if(res.result){
                            btnFollow.dataset.follow = '0';
                            btnFollow.classList.remove('btn-outline-secondary');
                            btnFollow.classList.add('btn-primary');
                            if(btnFollow.dataset.youme === '1'){
                                btnFollow.innerText ='맞팔로우 하기';
                            }else{
                                btnFollow.innerText = '팔로우';
                            }
                        }
                    });
                    break;
                case '0':   // 팔로우 등록
                fetch(followUrl,{
                    method: 'POST',
                    body: JSON.stringify(param)
                })
                .then(res=>res.json())
                .then(res=>{
                    if(res.result){
                        btnFollow.dataset.follow = '1';
                        btnFollow.classList.add('btn-outline-secondary');
                        btnFollow.classList.remove('btn-primary');
                        btnFollow.innerText ='팔로우 취소';
                    }
                });
                    break;
            }
        });
    }
})();