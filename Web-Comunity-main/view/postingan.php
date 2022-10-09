<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create a post</h5>
    </div>
    <div class="modal-body">
        <div class="d-flex">
            <img width="50px" height="50px" class="rounded-pill mb-4" src="img/profil/<?= $row['foto_profil']; ?>" alt="">
            <div class="user ms-3 mt-2">
                <p class="fw-bold"><?= $row['username']; ?></p>
            </div>
        </div>
        <form  action="profile.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $row['id']; ?>" >
            <textarea style="border: none; outline:none;" name="postingan_text" id="post_text" cols="60" rows="8" placeholder="What do you think now..." name="potingan_text"></textarea>
            <select id="category" class="rounded-2" required name="kategori">
                <option value="all">All</option>
                <option value="javascript">Javascript</option>
                <option value="php">Php</option>
                <option value="java">Java</option>
                <option value="golang">Golang</option>
                <option value="ruby">Ruby</option>
                <option value="c++">C++</option>
            </select>
            <label for="category">Choose this category</label>
            <div class="mb-3 mt-2">
                <label for="formFile" class="form-label">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                </svg>
                Upload image</label>
                <input class="form-control" type="file" id="formFile" name="postingan_gambar" >
            </div>
            <button class="btn btn-primary" name="send">Send</button>
        </form>
    </div>
    </div>
</div>