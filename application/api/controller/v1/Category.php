<?php
namespace app\api\controller\v1;

use app\common\model\Category as CategoryModel;
use think\Controller;

class Category extends Controller
{
    /**
     * get goods in category page by category id
     */
    public function getGoodsByCategory(){
        $category_id = $this->request->param('category_id');
        if(!is_numeric($category_id)){
            throw new \app\common\exception\BaseException(['errorCode'=>'10000','code'=>'400','msg'=>'参数错误']);
        }
        if(!cache('category_'.$category_id)){
            $list = CategoryModel::with('goods')->where('id',$category_id)->find()->toArray();
            cache('category_'.$category_id,$list);
        }   
        return ReturnMsg('1001', cache('category_'.$category_id));
    }

    /**
     * get all category with json
     */
    public function getCategorys()
    {
        if(!cache('categorys')){
            $list = CategoryModel::where(true)->select()->toArray();
            cache('categorys',$list);
        }
        return ReturnMsg('1001', cache('categorys'));
    }

}
