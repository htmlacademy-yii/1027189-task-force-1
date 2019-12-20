<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use frontend\models\TasksFilterForm;

/**
 * @var yii\web\View $this
 * @var \frontend\models\Task[] $tasks
 */

$this->title = 'Новые задания';
?>
            <section class="new-task">
                <div class="new-task__wrapper">
                    <h1>Новые задания</h1>
                    <?php foreach($tasks as $task) {
                        print $this->render('singleTask', ['task' => $task]);
                    } ?>
                </div>
                <div class="new-task__pagination">
                    <ul class="new-task__pagination-list">
                        <li class="pagination__item"><a href="#"></a></li>
                        <li class="pagination__item pagination__item--current">
                            <a>1</a></li>
                        <li class="pagination__item"><a href="#">2</a></li>
                        <li class="pagination__item"><a href="#">3</a></li>
                        <li class="pagination__item"><a href="#"></a></li>
                    </ul>
                </div>
            </section>
            <section  class="search-task">
                <div class="search-task__wrapper">
                    <?php ActiveForm::begin(['id' => 'tasks-filter-form', 'options' => ['class' => 'search-task__form']]); ?>
                        <fieldset class="search-task__categories">
                            <?php $field = new ActiveField(['model' => $model, 'attribute' => 'category']);
                            print $field->checkboxList($categories); ?>
                        </fieldset>
                        <fieldset class="search-task__categories">
                            <?php $field = new ActiveField(['model' => $model, 'attribute' => 'additionally']);
                            print $field->checkboxList(['Без исполнителя', 'Удалённая работа']); ?>
                        </fieldset>
                        <?php 
                        $field = new ActiveField(['model' => $model, 
                        'attribute' => 'period',
                        'labelOptions' => ['class' => 'search-task__name'],
                        'inputOptions' => ['class' => 'multiple-select input']
                        ]);
                        print $field->dropdownList(['day' => 'За день', 'week' => 'За неделю', 'month' => 'За месяц']);
                        $field = new ActiveField(['model' => $model, 
                        'attribute' => 'search',
                        'labelOptions' => ['class' => "search-task__name"],
                        'inputOptions' => ['class' => 'input-middle input']
                        ]);
                        print $field->textInput();
                        print Html::submitButton('Искать', ['class' => 'button']);
                        ?>


                        <!--
                        <fieldset class="search-task__categories">
                            <legend>Категории</legend>
                            <input class="visually-hidden checkbox__input" id="1" type="checkbox" name="" value="" checked>
                            <label for="1">Курьерские услуги </label>
                            <input class="visually-hidden checkbox__input" id="2" type="checkbox" name="" value="" checked>
                            <label  for="2">Грузоперевозки </label>
                            <input class="visually-hidden checkbox__input" id="3" type="checkbox" name="" value="">
                            <label  for="3">Переводы </label>
                            <input class="visually-hidden checkbox__input" id="4" type="checkbox" name="" value="">
                            <label  for="4">Строительство и ремонт </label>
                            <input class="visually-hidden checkbox__input" id="5" type="checkbox" name="" value="">
                            <label  for="5">Выгул животных </label>
                        </fieldset>
                        <fieldset class="search-task__categories">
                            <legend>Дополнительно</legend>
                            <input class="visually-hidden checkbox__input" id="6" type="checkbox" name="" value="">
                            <label for="6">Без исполнителя </label>
                            <input class="visually-hidden checkbox__input" id="7" type="checkbox" name="" value="" checked>
                            <label for="7">Удаленная работа </label>
                        </fieldset>
                        <label class="search-task__name" for="8">Период</label>
                            <select class="multiple-select input" id="8"size="1" name="time[]">
                            <option value="day">За день</option>
                            <option selected value="week">За неделю</option>
                            <option value="month">За месяц</option>
                            </select>
                        <label class="search-task__name" for="9">Поиск по названию</label>
                            <input class="input-middle input" id="9" type="search" name="q" placeholder="">
                        <button class="button" type="submit">Искать</button>
                        -->
                    <?php ActiveForm::end() ?>
                </div>
            </section>