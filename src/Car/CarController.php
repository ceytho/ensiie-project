<?php
namespace Car;
use PDO;

class CarController {
	private CarRepository $carRepository;
	private CarView $carView;

	public function __construct(PDO $connection) {
		$this->carRepository = new CarRepository($connection);
		$this->carView = new CarView();
	}

	public function afficheVoitures() {
		try {
			$this->carView->afficheVoitures($this->carRepository->fetchAll());
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function afficheVoiture($id) {
		try {
			$voitures[] = $this->carRepository->fetch($id);
			$this->carView->afficheVoitures($voitures);
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function afficheVoituresIndex() {
		try {
			$this->carView->afficheVoituresIndex($this->carRepository->fetchAll());
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}
}
?>
