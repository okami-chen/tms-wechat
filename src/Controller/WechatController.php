<?php

namespace OkamiChen\TmsWechat\Controller;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use OkamiChen\TmsWechat\Entity\Wechat;
use OkamiChen\TmsMobile\Entity\Mobile;
use Encore\Admin\Grid\Filter;

class WechatController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('微信');
            $content->description('');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('微信');
            $content->description('');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('微信');
            $content->description('');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Wechat::class, function (Grid $grid) {

            $states = [
                'on'  => ['value' => 1, 'text' => '正常', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '限登', 'color' => 'default'],
            ];
                        
            $grid->id('编号')->sortable();
            $grid->column('is_active','状态')->switch($states);
            $grid->column('phone.name', '姓名');
            $grid->column('name', '实名');
            $grid->column('mobile', '手机号');
            $grid->column('created_at','创建时间');
            
            $grid->filter(function(Filter $filter){
                $filter->disableIdFilter();
                $filter->like('mobile', '手机');
            });
            
            $grid->paginate(50);
            
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Wechat::class, function (Form $form) {

            $form->display('id', '编号');
            $form->text('name', '姓名');
            
            $ajax  = route('tms.service.mobile.search');
            $form->select('mobile_id', '关联')->options(function ($id) {
                $card = Mobile::find($id);
                if ($card) {
                    return [$card->id => $card->name .' | '.$card->mobile];
                }
            })->ajax($ajax);
            
            $states = [
                'on'  => ['value' => 1, 'text' => '正常', 'color' => 'primary'],
                'off' => ['value' => 0, 'text' => '限登', 'color' => 'default'],
            ];
            $form->switch('is_active','状态')->states($states)->default(1);
            $form->mobile('mobile','手机');
            
            $form->display('created_at', '创建时间');
            $form->display('updated_at', '修改时间');
        });
    }
}
