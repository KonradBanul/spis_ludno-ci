    <?php $data = $obiekt->getData(); ?>
        <div id="cols" class="row justify-content-md-center">
            <div class="col-12 col-form col-xl-3" id="col-1">
                <h3 id="h3">Formularz</h3><br>
                <form id="form" action="index.php" method="post" >
                    <input type="hidden" name="addPeople" value="1">
                    <input id="id" type="hidden" name="id" value="<?= $row['id'] ?? 0 ?>" >
                    <div class="form-floating mb-3">
                        <input id="imie" type="text" name="imie" class="form-control" placeholder="imie" value="<?= $row['imie'] ?? ''; ?>">
                        <label for="imie">Imię</label>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input id="nazwisko" type="text" name="nazwisko" class="form-control" placeholder="nazwisko" value="<?= $row['nazwisko'] ?? ''; ?>">
                        <label for="nazwisko">Nazwisko</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="adres" type="text" name="adres" class="form-control" placeholder="adres" value="<?= $row['adres'] ?? ''; ?>">
                        <label for="adres">Adres</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="email" type="email" name="email" class="form-control" placeholder="email" value="<?= $row['email'] ?? ''; ?>">
                        <label for="email">Email</label>
                    </div>
                    <button type="submit" class="btn btn-primary" id="addbtn" >Wyślij</button> <button type="button" class="btn btn-primary" id="addbtnjs" onclick="addRow()">Wyślij JS</button>   
                </form>
            </div>
            <div class="col-12 col-text col-xl-3" id="lorem">
                <h3>Lorem ipsum</h3><br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Vestibulum at quam quis elit porttitor tincidunt. Pellentesque habitant morbi tristique 
                senectus et netus et malesuada fames ac turpis egestas. Vivamus sed varius libero. 
                Aliquam eget lacus nisl. Duis sit amet mollis justo. Fusce non ipsum eget nulla blandit 
                consequat hendrerit et dolor. Vestibulum eget maximus ante. Pellentesque pharetra, 
                sem nec dapibus lobortis, leo velit iaculis libero, sit amet consequat urna 
                enim eget magna. Nullam ut cursus dolor. Sed accumsan tellus ut velit hendrerit, 
                vitae feugiat leo tempor. Morbi aliquet in dolor sed molestie. Praesent molestie, 
                metus eu gravida accumsan, nisi quam scelerisque velit, ut finibus nisi ex id eros dolor. 
            </div>
            <div class="col-xl-6 col-12 col-lg-6" id="col-3">
                <h3 class="text-center">Dane</h3><br>
                <table id="table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" type="button" class="sort" name="imie" data-order="" onclick="sort(event)">Imię<i class="fa"></i></th>
                            <th scope="col" type="button" class="sort" name="nazwisko" data-order="" onclick="sort(event)">Nazwisko<i class="fa"></i></th>
                            <th scope="col" type="button" class="sort" name="adres" data-order="" onclick="sort(event)">Adres<i class="fa"></i></th>
                            <th scope="col" type="button" class="sort" name="email" data-order="" onclick="sort(event)">Email<i class="fa"></i></th>
                            <th scope="col" id="clock"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php include_once('views/rows.php') ?>             
                    </tbody>
                </table>
            </div>
        </div>


           