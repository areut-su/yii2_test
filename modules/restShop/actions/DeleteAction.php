<?php

namespace app\modules\restShop\actions;

use app\modules\restShop\models\ShopCategory;
use Yii;
use yii\db\Exception;
use yii\rest\Action;
use yii\web\ServerErrorHttpException;

/**
 * DeleteAction implements the API endpoint for deleting a model.
 *
 * For more details and usage information on DeleteAction, see the [guide article on rest controllers](guide:rest-controllers).
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DeleteAction extends Action
{
  /**
   * @param $id
   * @return array
   * @throws Exception
   * @throws ServerErrorHttpException
   * @throws \Throwable
   * @throws \yii\web\NotFoundHttpException
   */
  public function run($id)
  {
    // можно сделать валидацию и вернуть результат валидации
    $model = $this->findModel($id);
    /**
     * @var $model ShopCategory
     */
    if ($this->checkAccess) {
      call_user_func($this->checkAccess, $this->id, $model);
    }
    if (($result = $model->delete()) === false) {
      throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
    } else if ($result === 417) {
      Yii::$app->getResponse()->setStatusCode(417);
      return [['message' => 'Foreign key constraint fails']];
    }
    Yii::$app->getResponse()->setStatusCode(204);
  }
}
