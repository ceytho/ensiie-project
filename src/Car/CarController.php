<?php
namespace Car;
use PDO;
use Exception;

class CarController {
	private CarRepository $carRepository;
	private CarView $carView;
	private \Location\LocationRepository $locationRepository;

	public function __construct(PDO $connection) {
		$this->carRepository = new CarRepository($connection);
		$this->carView = new CarView();
		$this->locationRepository = new \Location\LocationRepository($connection, $this->carRepository);
	}

	public function afficheVoitures() {
		try {
			$this->carView->afficheVoitures($this->carRepository->fetchAll());
		} catch(Exception $e) {
			//$this->connexionView->vue_erreur($e->getMessage());
		}
	}

	public function afficheVoiture($post) {
		try {
			$voitures[] = $this->carRepository->fetch($post);
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

	public function createLocation($post)
    {
        try {
			$date_debut = new \DateTimeImmutable($post['date_debut']);
			$date_fin = new \DateTimeImmutable($post['date_fin']);

            $this->locationRepository->create($date_debut,$date_fin,$post['id_voiture'],$post['km_max']);
            $this->carView->afficheLocation($post);
        } catch (Exception $e) {
            //$this->userView->vueErreur($e->getMessage());
        }
    }
}
?>
