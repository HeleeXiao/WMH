;var Vilidata = {
    reg_error   : "格式不正确",
    length_error: "必须输入",
    /**
     * 正则验证（按需添加）
     */
    regs     :{
        "email" : /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/,
        "phone": /^\d{11}$/,
        "idcard": /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/,
        "chinese":/^[A-Za-z\u4e00-\u9fa5]{1,45}$/,
        "japanese":/^[ァ-ヶー]{1,45}$/,
        "zipcode":/^\d{7}$/,
        // "password":/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,20}$/
        "password": /^[0-9A-Za-z]{8,10}$/
        
    },
    /*
     * 提示信息存在时长
     */
    times: 300,
    /*
     * 背景颜色
     */
    style: [2, '#e53e49'],
    /**
     * TODO 检查（挑选）属性
     * obj      object    Must.         检查范围
     * way.submit   boolean | function      检查通过后的执行方式 ：true = form提交  | function
     * way.form     string                  form提交时的form id
     */
    //check: function (obj,submit,form) {
    check: function (obj, way) {

        if (!arguments[1]) {
            way = {
                submit: false,
                form: false,
                times: this.times
            };
        }

        /**
         * TODO 验证参数
         */
        if (typeof obj !== "object") {
            console.log("code error :　parameter must is object !");
            return "code error :　parameter must is object !"
        }

        /**
         * TODO way.submit  = boolean
         */

        if ((way.submit === true) && !way.form || (!way.submit && way.form))
        {
            console.log("code error :　parameter number error ( must 2 ) !");
            return "code error :　parameter number error ( must 2 ) !"
        }

        /**
         * TODO 关闭所有tips .closeAll tips
         */
        if (way.submit === true && way.form || typeof way.submit === "function")
        {
            layer.closeAll();
        }
        /**
         * TODO 设置tips生存时间 .Set tips survival time
         */
        this.times = (way.times == "&" ? 100000 : way.times);
        /**
         *检查（挑选）属性
         */
        var selectObj = [];
        var flag = true;
        for (item in obj) {
            /**
             * 剔除非对象属性
             */

            if (typeof obj[item] !== "object" || obj[item].nodeName === "#document" || !obj[item].nodeName) {
                delete obj[item];
                /**
                 * 剔除非INPUT类型属性
                 */
            } else if (obj[item].nodeName === "SELECT") {

                selectObj.push(obj[item]);

                // console.debug($(obj[item]).attr("vili-required"))

                if ($(obj[item]).attr("vili-required") != "false") {
                   /* console.log($(obj[item]))*/
                    $(obj[item]).on("change", function () {
                        var p = $(this).children('option:selected').val();
                        var index = layer.tips("请选择", p, {tips: this.style, tipsMore: false, time: this.times});
                    });
                }

            } else if ($(obj[item]).attr("type") === "hidden") {

                delete obj[item];

            } else {
                //console.debug($(obj[item]).attr("id"))
                /*
                 * 验证所有输入是否正确
                 */
                if (way.submit === true || typeof way.submit === "function")
                {
                    if( this.verify(obj[item],true) !== "success" )
                    {
                        flag = false;
                    }
                }
                this.bindEvent(obj[item]);

            }
        }

        if (this.verifySelect(selectObj, way) !== "success") {
            flag = false;
        }

        /*
         * 所有输入正确则提交表单
         */
        if(flag)
        {
            /**
             * TODO way.submit  = function
             */
            if (typeof way.submit === "function") {
                way.submit();

            } else if (way.submit === true) {
                $("#" + way.form).submit();
            }
        }
        // console.error(selectObj);
        return flag;
    },
    /**
     * TODO 为对象绑定事件
     * @param obj           操作对象
     */
    bindEvent: function (obj) {
        var index;
        /**
         * 按下按键
         */
        //$(obj).bind("keyup", function () {
        //    index = Vilidata.verify($(obj));
        //});
        /**
         * 失去焦点
         */
        $(obj).on("blur", function () {
            index = Vilidata.verify($(obj));
        });
        /**
         * 获得焦点
         */
        $(obj).on("focus", function () {

            if( $(obj).attr('layer-index') )
            {
                layer.close($(obj).attr('layer-index'));
                $("#layui-layer"+$(obj).attr('layer-index')).remove();
                $(obj).removeAttr("layer-index");

            }else{
                layer.close(index);
            }
        });
    },

    /**
     * TODO 验证
     * @param obj           操作对象
     * @param eventType     事件类型    default : keyup() && focus()
     * @param reg           正则        default : -
     */
    verify: function (obj,attr) {
        /**
         * 非空验证
         */

        if ($(obj).attr("vili-required") != "false")
        {

            if ($(obj).val().trim() == "") {
                var index = layer.tips('请填写', $(obj), {tips: this.style, tipsMore: true, time: this.times});
                if(attr)
                {
                    $(obj).attr('layer-index',index);
                }
                return index;
            }
        }

        /**
         * 正则验证
         */
        if (typeof $(obj).attr("vili-reg") !== "undefined" && $(obj).val().length > 0)
        {

            if (!this.regs[($(obj).attr("vili-reg"))].test($(obj).val())) {
                if ($(obj).attr("reg-msg")) {
                    this.reg_error = $(obj).attr("reg-msg");
                } else {
                    this.reg_error = "格式不正确";
                }

                var index = layer.tips(this.reg_error, $(obj), {tips: this.style, tipsMore: true, time: this.times});
                if(attr)
                {
                    $(obj).attr('layer-index',index);
                }
                return index;
            }
        }

        /*
         * length验证
         */
        if (typeof $(obj).attr("vili-length") !== "undefined")
        {

            if ($(obj).val().trim().length != $(obj).attr("vili-length"))
            {
                var index = layer.tips(this.length_error + $(obj).attr("vili-length") + "个字符", $(obj), {
                    tips: this.style,
                    tipsMore: true,
                    time: this.times
                });
                return index;
            }
        }


        /*
         * 元素对比验证[如再次输入密码]
         * @element
         * 必要参数  attr: trace-element="参照元素的ID"
         */
        if (typeof $(obj).attr("trace-element") !== "undefined") {

            if ($(obj).val() !== $("#" + $(obj).attr("trace-element")).val()) {
                var index = layer.tips("两次输入不一致", $(obj), {tips: this.style, tipsMore: true, time: this.times});
                return index;
            }
        }
        return "success";
    },

    /**
     *
     * select 必选验证
     *
     */
    verifySelect: function (obj, way) {
        var flag = true;

        if ((way.submit === true && way.form) || typeof way.submit === "function") {
            for (item in obj) {
                if ($(obj[item]).attr("vili-required") !== "false") {
                    if ($(obj[item]).val() == "") {
                        var index = layer.tips("请选择", $(obj[item]), {
                        	tips: this.style,
                        	tipsMore: true, 
                        	time: this.times
                        });
                        return index;
                    }
                }
            }
            
        }

        return "success";
    }
};
