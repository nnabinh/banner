<?php
class Banner extends Controller {
    protected function Index() {
        $viewmodel = new BannerModel();
        $this->ReturnView($viewmodel->Index(), true);
    }
}
