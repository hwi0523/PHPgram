<div id="lData" data-toiuser="<?=$this->data->iuser?>"></div>
<div class="d-flex flex-column align-items-center">
    <div class="size_box_100"></div>
    <div class="w100p_mw614">
        <div class="d-flex flex-row">    
            <div class="d-flex flex-column justify-content-center me-3">
                <div class="circleimg h150 w150 pointer feedwin">
                    <img class="profileimg" data-bs-toggle="modal" data-bs-target="#profileImgModal" src='/static/img/profile/<?=$this->data->iuser?>/<?=$this->data->mainimg?>' onerror='this.error=null;this.src="/static/img/profile/Te.png"'>
                </div>
            </div>
            <div class="flex-grow-1 d-flex flex-column justify-content-evenly">
                <div><?=$this->data->email?>
                <?php
                    if($this->data->iuser === getIuser()){
                        print '<button type="button" id="btnModProfile" class="btn btn-outline-secondary">프로필 수정</button>';
                    }else if($this->data->meyou === 1){
                        print '<button type="button" id="btnFollow" data-follow="1" data-youme=' . $this->data->youme . ' class="btn btn-outline-secondary">팔로우 취소</button>';
                    }else if($this->data->meyou === 0 && $this->data->youme === 1){
                        print '<button type="button" id="btnFollow" data-follow="0" data-youme=' . $this->data->youme . ' class="btn btn-primary">맞팔로우 하기</button>';
                    }else{
                        print '<button type="button" id="btnFollow" data-follow="0" data-youme=' . $this->data->youme . ' class="btn btn-primary">팔로우</button>';        
                    }
                
                ?>
                        <!-- <button type="button" id="btnModProfile" class="<?= $this->data->iuser === getIuser() ? '' : 'd-none'?> btn btn-outline-secondary">프로필 수정</button>
                        <button type="button" id="btnFollow" data-follow="1" class="<?= $this->data->meyou === 1 ? '' : 'd-none'?> btn btn-outline-secondary">팔로우 취소</button>
                        <button type="button" id="btnFollow" data-follow="0" class="<?= $this->data->meyou === 0 && $this->data->youme === 1 ? '' : 'd-none'?> btn btn-primary">맞팔로우 하기</button>
                        <button type="button" id="btnFollow" data-follow="0" class="<?= $this->data->iuser !== getIuser() && $this->data->meyou === 0 && $this->data->youme === 0 ? '' : 'd-none'?> btn btn-primary">팔로우</button> -->

                </div>
                <div class="d-flex flex-row">
                    <div class="flex-grow-1 me-3">게시물 <span class="bold" id="spancnt"><?=$this->data->feedcnt?></span></div>
                    <div class="flex-grow-1 me-3">팔로워 <span class="bold" id="spanfollow"><?=$this->data->followerCnt?></span></div>
                    <div class="flex-grow-1">팔로우 <span class="bold"><?=$this->data->followCnt?></span></div>
                </div>
                <div class="bold"><?=$this->data->nm?></div>
                <div><?=$this->data->cmt?></div>
            </div>
        </div>
        <div id="item_container"></div>
    </div>
    <div class="loading d-none"><img src="/static/img/loading.gif"></div>
</div>

<!-- Profile Image Modal -->
<div class="modal fade" id="profileImgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title bold">프로필 사진 바꾸기</h5>
            </div>
            <div id="uploadImg" class="text-center">
                    <span id="btnInsProfilePic" class="text-primary fw-bold pointer">사진 업로드</span>
            </div>
            <div class="_modal_item">
                <span id="btnDelCurrentProfilePic" class="c_error-or-destructive bold pointer">현재 사진 삭제</span>
            </div>
            <div class="_modal_item">
                <span class="pointer" id="btnProfileImgModalClose" data-bs-dismiss="modal">취소</span>
            </div>
        </div>
        <form class="d-none">
            <input type="file" accept="image/*" name="imgs">
        </form>
    </div>
</div>