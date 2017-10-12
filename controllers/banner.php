<?php
class Banner extends Controller {
    //======================================================================
    // List available banners
    //======================================================================
    protected function Index() {
        $viewmodel = new BannerModel();
        $this->ReturnView($viewmodel->Index(), true);
    }

    //======================================================================
    // Update banner's period (start & end datetime)
    //======================================================================
    protected function updatePeriod() {
        $viewmodel = new BannerModel();
        $this->returnView($viewmodel->updatePeriod(), true);
    }
}
