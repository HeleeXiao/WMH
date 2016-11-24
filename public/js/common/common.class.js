var Common = {
        follow_url : '',
        _token : '',
        register_url : '',
        login_url : '',
        follow : function ( user_id , field , value , callback , unCallback) {
            if( ! user_id )
            {
                window.location.href = this.login_url;
                return false;
            }
            $.post(
                this.follow_url,
                {user_id:user_id,field:field,value:value,_token:this._token},
                function (res) {
                    if(res.status == 200){
                        layer.msg(res.message);
                        if(res.result.state == 0)
                        {
                            callback();
                            return true;
                        }else if(res.result.state == 1){
                            unCallback();
                            return true;
                        }
                    }
                    layer.msg(res.message);
                    return false;
                })
        }
};