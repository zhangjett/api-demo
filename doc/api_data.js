define({ "api": [
  {
    "type": "post",
    "url": "/areas",
    "title": "创建区域",
    "name": "create_area",
    "group": "area",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "创建区域": [
          {
            "group": "创建区域",
            "type": "String",
            "optional": false,
            "field": "area_name",
            "description": "<p>区域名称.</p>"
          },
          {
            "group": "创建区域",
            "type": "String",
            "optional": false,
            "field": "parent_id",
            "description": "<p>父级ID.</p>"
          },
          {
            "group": "创建区域",
            "type": "Number",
            "optional": false,
            "field": "area_type",
            "description": "<p>区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.</p>"
          },
          {
            "group": "创建区域",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>状态，1-正常，2-停用.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "创建区域_response": [
          {
            "group": "创建区域_response",
            "type": "Number",
            "optional": false,
            "field": "area_id",
            "description": "<p>区域ID.</p>"
          },
          {
            "group": "创建区域_response",
            "type": "String",
            "optional": false,
            "field": "area_name",
            "description": "<p>区域名称.</p>"
          },
          {
            "group": "创建区域_response",
            "type": "String",
            "optional": false,
            "field": "parent_id",
            "description": "<p>父级ID.</p>"
          },
          {
            "group": "创建区域_response",
            "type": "String",
            "optional": false,
            "field": "area_type",
            "description": "<p>区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.</p>"
          },
          {
            "group": "创建区域_response",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>状态，1-正常，2-停用.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/AreaController.php",
    "groupTitle": "区域"
  },
  {
    "type": "delete",
    "url": "/areas/:id",
    "title": "删除区域",
    "name": "delete_area",
    "group": "area",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "获取区域列表": [
          {
            "group": "获取区域列表",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>区域ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "获取区域列表_response": [
          {
            "group": "获取区域列表_response",
            "type": "Number",
            "optional": false,
            "field": "area_id",
            "description": "<p>区域ID.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "area_name",
            "description": "<p>区域名称.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "Number",
            "optional": false,
            "field": "parent_id",
            "description": "<p>父级ID.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "Number",
            "optional": false,
            "field": "area_type",
            "description": "<p>区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>状态，1-正常，2-停用.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/AreaController.php",
    "groupTitle": "区域"
  },
  {
    "type": "get",
    "url": "/areas",
    "title": "获取区域列表",
    "name": "get_area",
    "group": "area",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "获取区域列表": [
          {
            "group": "获取区域列表",
            "type": "String",
            "optional": true,
            "field": "area_name",
            "description": "<p>地区名称.</p>"
          },
          {
            "group": "获取区域列表",
            "type": "String",
            "allowedValues": [
              "1",
              "2",
              "3"
            ],
            "optional": true,
            "field": "area_type",
            "description": "<p>地区类型.</p>"
          },
          {
            "group": "获取区域列表",
            "type": "String",
            "optional": true,
            "field": "q",
            "description": "<p>搜索条件.</p>"
          },
          {
            "group": "获取区域列表",
            "type": "String",
            "optional": true,
            "field": "page",
            "defaultValue": "1",
            "description": "<p>页码.</p>"
          },
          {
            "group": "获取区域列表",
            "type": "String",
            "optional": true,
            "field": "per-page",
            "defaultValue": "20",
            "description": "<p>每页数量.</p>"
          },
          {
            "group": "获取区域列表",
            "type": "string",
            "allowedValues": [
              "\"area_id\"",
              "\"-area_id\"",
              "\"area_type\"",
              "\"-area_type\""
            ],
            "optional": true,
            "field": "sort",
            "description": "<p>排序字段</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "获取区域列表_response": [
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "area_id",
            "description": "<p>区域ID.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "area_name",
            "description": "<p>区域名称.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "parent_id",
            "description": "<p>父级ID.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "area_type",
            "description": "<p>区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>状态，1-正常，2-停用.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/AreaController.php",
    "groupTitle": "区域"
  },
  {
    "type": "get",
    "url": "/areas/:id",
    "title": "获取区域详情",
    "name": "get_area_detail",
    "group": "area",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "获取区域列表": [
          {
            "group": "获取区域列表",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>区域ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "获取区域列表_response": [
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "area_id",
            "description": "<p>区域ID.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "area_name",
            "description": "<p>区域名称.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "parent_id",
            "description": "<p>父级ID.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "area_type",
            "description": "<p>区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.</p>"
          },
          {
            "group": "获取区域列表_response",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>状态，1-正常，2-停用.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/AreaController.php",
    "groupTitle": "区域"
  },
  {
    "type": "put",
    "url": "/areas/:id",
    "title": "修改区域",
    "name": "update_area",
    "group": "area",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "修改区域名称": [
          {
            "group": "修改区域名称",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>用户ID.</p>"
          },
          {
            "group": "修改区域名称",
            "type": "String",
            "optional": false,
            "field": "scenario",
            "description": "<p>场景,此处值=updateName.</p>"
          },
          {
            "group": "修改区域名称",
            "type": "String",
            "optional": false,
            "field": "area_name",
            "description": "<p>区域名称.</p>"
          }
        ],
        "修改区域父级ID": [
          {
            "group": "修改区域父级ID",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>用户ID.</p>"
          },
          {
            "group": "修改区域父级ID",
            "type": "String",
            "optional": false,
            "field": "scenario",
            "description": "<p>场景,此处值=updateParentId.</p>"
          },
          {
            "group": "修改区域父级ID",
            "type": "String",
            "optional": false,
            "field": "parent_id",
            "description": "<p>父级ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "修改区域名称_response": [
          {
            "group": "修改区域名称_response",
            "type": "Number",
            "optional": false,
            "field": "area_id",
            "description": "<p>区域ID.</p>"
          },
          {
            "group": "修改区域名称_response",
            "type": "String",
            "optional": false,
            "field": "area_name",
            "description": "<p>区域名称.</p>"
          },
          {
            "group": "修改区域名称_response",
            "type": "Number",
            "optional": false,
            "field": "parent_id",
            "description": "<p>父级ID.</p>"
          },
          {
            "group": "修改区域名称_response",
            "type": "Number",
            "optional": false,
            "field": "area_type",
            "description": "<p>区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.</p>"
          },
          {
            "group": "修改区域名称_response",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>状态，1-正常，2-停用.</p>"
          }
        ],
        "修改区域父级ID_response": [
          {
            "group": "修改区域父级ID_response",
            "type": "Number",
            "optional": false,
            "field": "area_id",
            "description": "<p>区域ID.</p>"
          },
          {
            "group": "修改区域父级ID_response",
            "type": "String",
            "optional": false,
            "field": "area_name",
            "description": "<p>区域名称.</p>"
          },
          {
            "group": "修改区域父级ID_response",
            "type": "String",
            "optional": false,
            "field": "parent_id",
            "description": "<p>父级ID.</p>"
          },
          {
            "group": "修改区域父级ID_response",
            "type": "Number",
            "optional": false,
            "field": "area_type",
            "description": "<p>区域类型,1-省/自治区/直辖市;2-地区(省下面的地级市);3-县/市(县级市)/区.</p>"
          },
          {
            "group": "修改区域父级ID_response",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>状态，1-正常，2-停用.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/AreaController.php",
    "groupTitle": "区域"
  },
  {
    "type": "post",
    "url": "/users",
    "title": "注册用户",
    "name": "create_user",
    "group": "user",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "注册用户": [
          {
            "group": "注册用户",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号.</p>"
          },
          {
            "group": "注册用户",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "注册用户_response": [
          {
            "group": "注册用户_response",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户ID.</p>"
          },
          {
            "group": "注册用户_response",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p>"
          },
          {
            "group": "注册用户_response",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号.</p>"
          },
          {
            "group": "注册用户_response",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>创建时间.</p>"
          },
          {
            "group": "注册用户_response",
            "type": "String",
            "optional": false,
            "field": "update_time",
            "description": "<p>修改时间.</p>"
          },
          {
            "group": "注册用户_response",
            "type": "String",
            "optional": false,
            "field": "access_token",
            "description": "<p>token.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/UserController.php",
    "groupTitle": "用户"
  },
  {
    "type": "delete",
    "url": "/users/:id",
    "title": "删除用户",
    "name": "delete_user",
    "group": "user",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "获取用户": [
          {
            "group": "获取用户",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>用户ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "修改密码_response": [
          {
            "group": "修改密码_response",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户ID.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>用户名.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "nick_name",
            "description": "<p>昵称.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>状态.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "access_token",
            "description": "<p>token.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>创建时间.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "update_time",
            "description": "<p>修改时间.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/UserController.php",
    "groupTitle": "用户"
  },
  {
    "type": "post",
    "url": "/authentications",
    "title": "获取token(登录)",
    "name": "get_token",
    "group": "user",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "登录": [
          {
            "group": "登录",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号.</p>"
          },
          {
            "group": "登录",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "登录_response": [
          {
            "group": "登录_response",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户ID.</p>"
          },
          {
            "group": "登录_response",
            "type": "String",
            "optional": false,
            "field": "access_token",
            "description": "<p>token.</p>"
          },
          {
            "group": "登录_response",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/AuthenticationController.php",
    "groupTitle": "用户"
  },
  {
    "type": "get",
    "url": "/users",
    "title": "获取用户",
    "name": "get_user",
    "group": "user",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "获取区域列表": [
          {
            "group": "获取区域列表",
            "type": "String",
            "optional": true,
            "field": "page",
            "defaultValue": "1",
            "description": "<p>页码.</p>"
          },
          {
            "group": "获取区域列表",
            "type": "String",
            "optional": true,
            "field": "per-page",
            "defaultValue": "20",
            "description": "<p>每页数量.</p>"
          },
          {
            "group": "获取区域列表",
            "type": "string",
            "allowedValues": [
              "\"user_id\"",
              "\"-user_id\""
            ],
            "optional": true,
            "field": "sort",
            "description": "<p>排序字段</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "获取用户列表_response": [
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户ID.</p>"
          },
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号.</p>"
          },
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p>"
          },
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>用户名.</p>"
          },
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "nick_name",
            "description": "<p>昵称.</p>"
          },
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "access_token",
            "description": "<p>access_token.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/UserController.php",
    "groupTitle": "用户"
  },
  {
    "type": "get",
    "url": "/users/:id",
    "title": "获取用户详情",
    "name": "get_user_detail",
    "group": "user",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "获取用户": [
          {
            "group": "获取用户",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>用户ID.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "获取用户列表_response": [
          {
            "group": "获取用户列表_response",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户ID.</p>"
          },
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号.</p>"
          },
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p>"
          },
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>用户名.</p>"
          },
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "nick_name",
            "description": "<p>昵称.</p>"
          },
          {
            "group": "获取用户列表_response",
            "type": "String",
            "optional": false,
            "field": "access_token",
            "description": "<p>access_token.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/UserController.php",
    "groupTitle": "用户"
  },
  {
    "type": "put",
    "url": "/users/:id",
    "title": "修改用户信息",
    "name": "update_user",
    "group": "user",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "修改密码": [
          {
            "group": "修改密码",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>用户ID.</p>"
          },
          {
            "group": "修改密码",
            "type": "String",
            "optional": false,
            "field": "scenario",
            "description": "<p>场景,此处值=updatePassword.</p>"
          },
          {
            "group": "修改密码",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "修改密码_response": [
          {
            "group": "修改密码_response",
            "type": "Number",
            "optional": false,
            "field": "user_id",
            "description": "<p>用户ID.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "phone",
            "description": "<p>手机号.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>密码.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>用户名.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "nick_name",
            "description": "<p>昵称.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "Number",
            "optional": false,
            "field": "status",
            "description": "<p>状态.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "access_token",
            "description": "<p>token.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>创建时间.</p>"
          },
          {
            "group": "修改密码_response",
            "type": "String",
            "optional": false,
            "field": "update_time",
            "description": "<p>修改时间.</p>"
          }
        ]
      }
    },
    "filename": "./controllers/UserController.php",
    "groupTitle": "用户"
  }
] });
