<?php
namespace frontend\controllers;

use common\models\gl\GlGroups;
use common\models\gl\GlImgs;
use common\models\gl\GlTypes;
use Yii;
use yii\web\Controller;

class GalleryController extends Controller
{
    public $layout = false;
    /*
     * URL to the images path
     */
    const IMAGE_PATH = '/img';
    /*
     * URL to the directory tmp path
     */
    const TMP_PATH = '/img/tmp';

    public function actionUpload()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            switch (Yii::$app->request->post('action')) {

                case "addGroup":
                    $group = new GlGroups();
                    $type = GlTypes::findOne(['type' => Yii::$app->request->post('type')]);
                    $group->types_id = $type->id;
                    $group->save();
                    return [
                        'success' => true,
                        'groups_id' => $group->id,
                    ];
                    break;

                case "uploadImage":
                    $group = new GlGroups();
                    if (Yii::$app->request->post('groups_id')) {
                        $group = GlGroups::findOne(Yii::$app->request->post('groups_id'));
                        $type = GlTypes::findOne($group->types_id);
                    } else {

                    }

                    $file = $_FILES['input_file_name'];

                    if (GlImgs::findOne(['groups_id' => $group->id, 'basename_src' => $file['name']])) {
                        return [
                            'success' => false,
                            'index' => Yii::$app->request->post('index'),
                            'error' => 'Вы уже загружали эту фотографию',
                        ];
                    }

                    $src_image = Yii::getAlias('@webroot').self::TMP_PATH.'/'.$file['name'];
                    $dst_path = Yii::getAlias('@webroot').$type->dir_dst;
                    move_uploaded_file($file['tmp_name'], $src_image);
                    $images = (new GlImgs())->convertImg($type->id, $src_image, $dst_path);
                    unlink($src_image);

                    $last_image = GlImgs::find()->where(['groups_id' => $group->id])->orderBy(['seq' => SORT_DESC])->one();

                    $image = new GlImgs();
                    $image->img_small = self::IMAGE_PATH.'/'.$type->type.'/'.$images['img_small'];
                    $image->img_large = self::IMAGE_PATH.'/'.$type->type.'/'.$images['img_large'];
                    $image->basename_src = $file['name'];
                    $image->seq = $last_image ? $last_image->seq + 1 : 1;

                    $image->groups_id = $group->id;
                    $image->save();

                    if (!$group->imgs_id) {
                        $group->imgs_id = $image->id;
                        $group->update();
                    }

                    return [
                        'success' => true,
                        'index' => Yii::$app->request->post('index'),
                        'id' => $image->id,
                        'basename_src' => $image->basename_src,
                        'img_small' => $image->img_small,
                    ];
                    break;

                case "deleteImage":
                    $f = fopen(Yii::getAlias('@webroot'.'/img/tmp/upload.log'), 'a');
                    $image = GlImgs::findOne(['id' => Yii::$app->request->post('id'), 'basename_src' => Yii::$app->request->post('basename_src')]);
                    if (!$image) {
                        return [
                            'success' => false,
                            'error' => 'Файл не найден'
                        ];
                    }

                    $image->delete();
                    (new GlImgs())->reSort(Yii::$app->request->post('groups_id'));

                    $image = GlImgs::findOne(['groups_id' => Yii::$app->request->post('groups_id'), 'seq' => 1]);
                    $group = GlGroups::findOne(Yii::$app->request->post('groups_id'));
                    if (!$image) {
                        $group->delete();
                    }

                    if ($image && $group->imgs_id != $image->id) {
                        $group->imgs_id = $image->id;
                        $group->update();
                    }

                    fclose($f);

                    return [
                        'success' => true,
                        'groups_id' => $image ? $group->id : false,
                    ];
                    break;

                case "reSortGallery":
                    foreach (Yii::$app->request->post('images') as $imgs_id => $seq) {
                        $image = GlImgs::findOne($imgs_id);
                        $image->seq = $seq;
                        $image->save();

                        if ($seq == 1) {
                            $group = GlGroups::findOne($image->groups_id);
                            if ($group->imgs_id != $image->id) {
                                $group->imgs_id = $image->id;
                                $group->update();
                            }
                        }
                    }

                    return [
                        'success' => true,
                    ];
                    break;
            }

            return [
                'success' => false,
                'error' => 'На сервер передан неверный параметр',
            ];
        }
    }
}