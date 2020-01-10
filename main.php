<?php
  class Ferm {
    public $id;
    public $product;

    function __construct($id,$product)
    {
      $this->id = $id;
      $this->product = $product;
    }
  }
  class Cow extends Ferm {
    public static function collectCow ($newCountCow){
      $CowArr = array ();
      //добавление коров
      for ($i = 1; $i <= $newCountCow; $i++){
        array_push($CowArr, new Cow ($i,rand(8,12)));
      }
      echo "\nВсего коров $newCountCow\n";
      //Подсчет литров
      foreach ($CowArr as $item ) {
         global $sumMilk;
         $sumMilk = $sumMilk + $item->product;
      }
      echo "Молока собранно - ".$sumMilk." литров\n\n";
    }
  }
  class Chicken extends Ferm {
    public static function collectChicken ($newCountChicken) {
      //добавление куриц
      $chickenArr = array ();
      for ($i = 1; $i <= $newCountChicken; $i++){
        array_push($chickenArr, new Chicken ($i,rand(0,1)));
      }
      echo "Всего куриц $newCountChicken\n";
      //Подсчет яиц
      foreach ($chickenArr as $item ) {
          global $sumEggs;
          $sumEggs = $sumEggs + $item->product;
      }
      echo "Яиц собранно - ".$sumEggs." штук\n";
    }
  }
	function addAnimal ($countCow,$countChicken){
		//Начальное количество животных
		echo "\nВсего коров $countCow\n";
		echo "Всего куриц $countChicken\n\n";
		//Добавление животных
		$addCow = readline("Сколько добавить коров: ");
		$addChicken = readline("Сколько добавить куриц: ");

		if (is_numeric($addCow) and is_numeric($addChicken)){
			global $newCountCow;
			global $newCountChicken;
			$newCountCow = $countCow + $addCow;
			$newCountChicken = $countChicken + $addChicken;
		}else  {
			echo "Введите число!\n";
			addAnimal(10,20);
		}
	}
	addAnimal(10,20);
	//Обновление количества животных
	echo "\nКоличество коров - ".$newCountCow."\n";
	echo 'Количество куриц - '.	$newCountChicken."\n\n";
	//Сбор
	$d = 0;
	while ($d != 1) {
		$collect = readline ("Cобрать продукцию - collect, Изменить ко-во жив-ых - edit, Выйти - exit: ");
		if ($collect == 'collect'){
      Cow::collectCow($newCountCow);
      Chicken::collectChicken($newCountChicken);
			$allMilk = $allMilk + $sumMilk;
			$allEggs = $allEggs + $sumEggs;
			echo "\nВсего собранно ".$allMilk." литров молока и ".$allEggs." яиц\n\n";
		}else if ($collect == 'exit'){
			Exit();
		}else if ($collect == 'edit'){
					addAnimal($newCountCow,$newCountChicken);
				}
		else if ($collect != 'yes'){
			echo "Ошибка! Неправильно набранна команда!\n";
		}
	}
?>
