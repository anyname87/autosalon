<?php
class MarkTest extends CDbTestCase
{
    public $fixtures=array(
        'marks'=>'Mark',
    );

    public function testSave()
	{
		$count = 0;
		foreach ($this->marks as $mkey => $m) {
			$mark=new Mark;
			$mark->setAttributes(array(
				'id'=>$m['id'],
				'title'=>$mkey,
				'small_img'=>$m['small_img'],
				'full_img'=>$m['full_img'],
				'description'=>$m['description'],
				'group_cars_id'=>$m['group_cars_id'],
				'gallery_id'=>$m['gallery_id'],
				'priority'=>$m['priority'],
				'is_visible'=>$m['is_visible'],
			),false);

			$this->assertTrue($mark->save(false));
			$this->assertEquals($m['id'],$mark->id);
			$count++;
		}


		$marks=Mark::model()->findAll();
		$this->assertEquals($count,count($marks));

		foreach ($marks as $mkey => $m) {
			$this->assertEquals($m->id,$this->marks[$m->title]['id']);
			$this->assertEquals($m->small_img,$this->marks[$m->title]['small_img']);
			$this->assertEquals($m->full_img,$this->marks[$m->title]['full_img']);
			$this->assertEquals($m->description,$this->marks[$m->title]['description']);
		}
	}

}
?>