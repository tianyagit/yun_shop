!
    function(a, b) {
        "function" == typeof define && define.amd ? define(["jquery", "underscore", "webuploader", "jquery.jplayer", "bootstrap", "filestyle"],
            function(c, d, e) {
                return a.fileUploader = b(c, d, e)
            }) : "object" == typeof module && "object" == typeof module.exports ? module.exports = b(require("jquery"), require("underscore"), require("webuploader"), require("jquery.jplayer"), require("bootstrap"), require("filestyle")) : a.fileUploader = b(jQuery, underscore, WebUploader)
    } (window,
        function(a, b, c) {
            var d = {
                defaultoptions: {
                    direct: !1,
                    global: !1,
                    dest_dir: "",
                    callback: null,
                    type: "image",
                    mode: "",
                    multiple: !0,
                    allowUploadVideo: !0,
                    fileSizeLimit: !1,
                    uploader: {},
                    threads:1
                },
                uploader: {},
                show: function(a, b) {
                    return this.init(a, b)
                },
                upload_urls : null,
                image_urls : null,
                fetch_urls : null,
                delete_urls : null,
                video_urls : null,
                upload_url: function(upload_urls) {
                    this.upload_urls = upload_urls
                },
                image_url: function(image_urls) {
                    this.image_urls = image_urls
                },
                fetch_url: function(fetch_urls) {
                    this.fetch_urls = fetch_urls
                },
                delet_url: function(delete_urls) {
                    this.delete_urls = delete_urls
                },
                video_url: function(video_urls) {
                    this.video_urls = video_urls
                },
                init: function(b, c) {
                    var d = this;
                    let o = this.fetch_urls;
                    if (d.options = a.extend({},
                        d.defaultoptions, c), d.options.callback = b, this.options.isWechat) {
                        if (c.account_error) return util.message("公众号号没有上传素材的权限", "", "info"),
                            !1
                    } else this.options.global ? this.options.global = "global": this.options.global = "",
                        document.cookie = "__fileupload_type=" + escape(this.options.type),
                        document.cookie = "__fileupload_dest_dir=" + escape(this.options.dest_dir),
                        document.cookie = "__fileupload_global=" + escape(this.options.global);
                    return a("#modal-webuploader").remove(),
                    0 == a("#modal-webuploader").length && a(document.body).append(d.buildHtml().mainDialog),
                        d.modalobj = a("#modal-webuploader"),
                        d.modalobj.modal("show"),
                        d.modalobj.on("shown.bs.modal",
                            function() {
                                if (!a(this).data("init")) {
                                    switch (d.options.type) {
                                        case "image":
                                        case "thumb":
                                            d.options.isWechat || d.initRemote(o),
                                                d.initLocal();
                                            break;
                                        case "audio":
                                            d.initLocalAudio();
                                            break;
                                        case "voice":
                                            d.initLocalVoice();
                                            break;
                                        case "video":
                                            d.options.isWechat || d.initVideoRemote(),
                                            d.options.allowUploadVideo && d.initLocalVideo()
                                    }
                                    d.options.allowUploadVideo && d["init" + d.options.type.substring(0, 1).toUpperCase() + d.options.type.substring(1) + "Uploader"]()
                                }
                            }),
                        d.modalobj
                },
                initUploader: function(b) {
                    function e(e) {
                        var f = a('<li id="' + e.id + '"><p class="title"' + ("audio" == b || "voice" == b ? 'style="top:40px;"': "") + ">" + e.name + '</p><p class="imgWrap"' + ("audio" == b || "voice" == b ? 'style="top:30px;"': "") + "></p></li>"),
                            g = a('<div class="file-panel"><span class="cancel">删除</span></div>').appendTo(f),
                            h = f.find("p.progress span"),
                            i = f.find("p.imgWrap"),
                            j = a('<p class="error"></p>'),
                            k = function(a) {
                                switch (a) {
                                    case "exceed_size":
                                        text = "文件大小超出";
                                        break;
                                    case "interrupt":
                                        text = "上传暂停";
                                        break;
                                    default:
                                        text = "上传失败，请重试"
                                }
                                j.text(text).appendTo(f)
                            };
                        "invalid" === e.getStatus() ? k(e.statusText) : ("image" == b ? (i.text("预览中"), d.makeThumb(e,
                            function(b, c) {
                                if (b) return void i.text("不能预览");
                                var d = a('<img src="' + c + '">');
                                i.empty().append(d)
                            },
                            thumbnailWidth, thumbnailHeight)) : i.text(c.formatSize(e.size) + " kb"), percentages[e.id] = [e.size, 0], e.rotation = 0),
                            e.on("statuschange",
                                function(a, c) {
                                    "progress" === c ? h.hide().width(0) : "queued" === c && (f.off("mouseenter mouseleave"), g.remove()),
                                        "error" === a || "invalid" === a ? (k(e.statusText), percentages[e.id][1] = 1) : "interrupt" === a ? k("interrupt") : "queued" === a ? percentages[e.id][1] = 0 : "progress" === a && (j.remove(), "image" == b && h.css("display", "block")),
                                        f.removeClass("state-" + c).addClass("state-" + a)
                                }),
                            f.on("mouseenter",
                                function() {
                                    g.stop().animate({
                                        height: 30
                                    })
                                }),
                            f.on("mouseleave",
                                function() {
                                    g.stop().animate({
                                        height: 0
                                    })
                                }),
                            g.on("click", "span",
                                function() {
                                    var b, c = a(this).index();
                                    switch (c) {
                                        case 0:
                                            return void d.removeFile(e);
                                        case 1:
                                            e.rotation += 90;
                                            break;
                                        case 2:
                                            e.rotation -= 90
                                    }
                                    supportTransition ? (b = "rotate(" + e.rotation + "deg)", i.css({
                                        "-webkit-transform": b,
                                        "-mos-transform": b,
                                        "-o-transform": b,
                                        transform: b
                                    })) : i.css("filter", "progid:DXImageTransform.Microsoft.BasicImage(rotation=" + ~~ (e.rotation / 90 % 4 + 4) % 4 + ")")
                                }),
                        p.options.multiple && r.find(".fileinput-button").show(),
                            f.insertBefore(r.find(".fileinput-button"))
                    }
                    function f(b) {
                        var c = a("#" + b.id);
                        delete percentages[b.id],
                            g(),
                            c.off().find(".file-panel").off().end().remove()
                    }
                    function g() {
                        var b, c = 0,
                            d = 0,
                            e = w.children();
                        a.each(percentages,
                            function(a, b) {
                                d += b[0],
                                    c += b[0] * b[1]
                            }),
                            b = d ? c / d: 0,
                            e.eq(0).text(Math.round(100 * b) + "%"),
                            e.eq(1).css("width", Math.round(100 * b) + "%"),
                            h()
                    }
                    function h() {
                        var a, b = "";
                        if ("ready" === state) {
                            if (p.options.isWechat) {
                                if ("" == p.options.mode) var e = p.modalobj.find(".nav-pills li.active").attr("data-mode");
                                else var e = p.options.mode;
                                p.options.flag || (d.option("server", d.option("server") + "&mode=" + e + "&types=" + p.options.type), p.options.flag = 1)
                            }
                            b = "选中" + fileCount + typeUnit + j + "，共" + c.formatSize(fileSize) + "。"
                        } else "confirm" === state ? (a = d.getStats(), a.uploadFailNum && (b = "已上传" + a.successNum + typeUnit + j + "," + a.uploadFailNum + typeUnit + j + '上传失败，<a class="retry" href="#">重新上传</a>失败' + j + '或<a class="ignore" href="#">忽略</a>')) : (a = d.getStats(), b = "共" + fileCount + typeUnit + "（" + c.formatSize(fileSize) + "），已上传" + a.successNum + typeUnit, a.uploadFailNum && (b += "，失败" + a.uploadFailNum + typeUnit));
                        t.html(b)
                    }
                    function i(b) {
                        var c;
                        if (b !== state) {
                            switch (u.removeClass("state-" + state), u.addClass("state-" + b), state = b, state) {
                                case "pedding":
                                    v.removeClass("element-invisible"),
                                        r.hide(),
                                        d.refresh();
                                    break;
                                case "ready":
                                    v.addClass("element-invisible"),
                                    p.options.isWechat && "video" == p.options.type && a("#upload form").removeClass("hide"),
                                        r.show(),
                                        d.refresh();
                                    break;
                                case "uploading":
                                    w.show(),
                                        u.text("暂停上传");
                                    break;
                                case "paused":
                                    w.show(),
                                        u.text("继续上传");
                                    break;
                                case "confirm":
                                    if (w.hide(), u.text("开始上传").addClass("disabled"), c = d.getStats(), c.successNum && !c.uploadFailNum) return void i("finish");
                                    break;
                                case "finish":
                                    if (u.removeClass("disabled"), c = d.getStats(), c.successNum) {
                                        if (d.uploadedFiles.length > 0) return p.finish(d.uploadedFiles),
                                            void d.resetUploader()
                                    } else state = "done",
                                        location.reload()
                            }
                            h()
                        }
                    }
                    var j, k, l, m, n, o, p = this;
                    switch (b) {
                        case "image":
                            j = "图片",
                                typeUnit = "张",
                                k = {
                                    title: "Images",
                                    extensions: "gif,jpg,jpeg,bmp,png,ico",
                                    mimeTypes: "image/*"
                                },
                                l = 30,
                                m = 5242880,
                                n = l * m,
                                o = p.options.isWechat ? {
                                    quality: 80,
                                    preserveHeaders: !0,
                                    noCompressIfLarger: !0,
                                    compressSize: 1048576
                                }: !1;
                            break;
                        case "audio":
                        case "voice":
                            j = "音频",
                                typeUnit = "个",
                                k = {
                                    title: "Audios",
                                    extensions: "mp3,wma,wav,amr",
                                    mimeTypes: "audio/*"
                                },
                                l = 30,
                                m = 6291456,
                                n = l * m,
                                o = !1,
                            p.options.isWechat && (l = 5, "temp" == p.options.mode ? (k.extensions = "mp3", m = 2097152, n = 10485760) : (m = 5242880, n = 26214400));
                            break;
                        case "video":
                            j = "视频",
                                typeUnit = "个",
                                k = {
                                    title: "Video",
                                    extensions: "mpeg,mp4",
                                    mimeTypes: "video/*"
                                },
                                l = 30,
                                m = 50 * 1024 * 1024,
                                n = l * m,
                                o = !1,
                            p.options.isWechat && (l = 5, "temp" == p.options.mode ? (k.extensions = "mp4", m = 10485760, n = 52428800) : (m = 20971520, n = 104857600))
                    }
                    p.options.isWechat ? (p.options.flag = 0, p.modalobj.find("#li_upload_perm a").html("上传永久" + j), p.modalobj.find("#li_upload_temp a").html("上传临时" + j + "(保留3天)")) : p.modalobj.find("#li_upload a").html("上传" + j),
                        p.modalobj.find(".modal-body").append(this.buildHtml().uploaderDialog);
                    var q = a("#uploader"),
                        r = a('<ul class="filelist"><li class="fileinput-button js-add-image" id="filePicker2" style="display:none;background:#fff!important;border:solid 1px #ebebeb;display:flex;"> <a href="javascript:;" class="fileinput-button-icon">+</a></li></ul>').appendTo(q.find(".queueList")),
                        s = q.find(".statusBar"),
                        t = s.find(".info"),
                        u = q.find(".uploadBtn"),
                        v = q.find(".placeholder"),
                        w = s.find(".progress").hide();
                    q.find(".btn-primary");
                    fileCount = 0,
                        fileSize = 0,
                        ratio = window.devicePixelRatio || 1,
                        thumbnailWidth = 110 * ratio,
                        thumbnailHeight = 110 * ratio,
                        state = "pedding",
                        percentages = {},
                        supportTransition = function() {
                            var a = document.createElement("p").style,
                                b = "transition" in a || "WebkitTransition" in a || "MozTransition" in a || "msTransition" in a || "OTransition" in a;
                            return a = null,
                                b
                        } (),
                        d;
                    var x = {
                        pick: {
                            id: "#filePicker",
                            label: "点击选择" + j,
                            multiple: !0
                        },
                        dnd: "#dndArea",
                        paste: "#uploader",
                        swf: "./resource/componets/webuploader/Uploader.swf",
                        server: p.options.isWechat ? "./index.php?c=utility&a=wechat_file&do=upload": this.upload_urls + b,
                        compress: o,
                        accept: k,
                        fileNumLimit: l,
                        fileSizeLimit: n,
                        fileSingleSizeLimit: m,
                        threads:1
                    };
                    x = a.extend({},
                        x, p.options.uploader),
                        x.pick.multiple = p.options.multiple,
                        x.isWechat = p.options.isWechat,
                        x.type = p.options.type,
                        "audio" == b || "voice" == b ? p.options.isWechat ? a("#dndArea p").html("临时语音只支持amr/mp3格式,大小不超过为2M,长度不超过60秒<br>永久语音只支持mp3/wma/wav/amr格式,大小不超过为5M,长度不超过60秒") : a("#dndArea p").html("最大支持 " + c.formatSize(x.fileSingleSizeLimit) + " MB 以内的语音 (" + x.accept.extensions + " 格式)") : "video" == b && (p.options.isWechat ? a("#dndArea p").html("临时视频只支持mp4格式,大小不超过为10M<br>永久视频只支持rm/rmvb/wmv/avi/mpg/mpeg/mp4格式,大小不超过为20M") : a("#dndArea p").html("最大支持 " + c.formatSize(x.fileSingleSizeLimit) + " MB 以内的视频 (" + x.accept.extensions + " 格式)")),
                    p.options.fileSizeLimit && (x.fileSizeLimit = p.options.fileSizeLimit),
                        console.dir(x),
                        d = c.create(x),
                        d.uploadedFiles = [],
                        d.addButton({
                            id: "#filePicker2",
                            innerHTML:`<div style="color:#ebebeb;font-size:48px;line-height:96px;">+</div>`,
                            label: "+",
                            multiple: p.options.multiple
                        }),
                        k = 0,
                        d.resetUploader = function() {
                            if (fileCount = 0, fileSize = 0, k = 0, d.uploadedFiles = [], a.each(d.getFiles(),
                                function(a, b) {
                                    f(b)
                                }), p.options.isWechat) {
                                p.options.video && (a("#upload :text[name='title']").val(""), a("#upload :text[name='introduction']").val("")),
                                    g(),
                                    d.reset(),
                                    d.refresh(),
                                    a("#dndArea").removeClass("element-invisible"),
                                    a("#uploader").find(".filelist").empty(),
                                    a("#filePicker").find(".webuploader-pick").next().css({
                                        left: "190px"
                                    });
                                var b = a("#uploader").find(".statusBar");
                                b.find(".info").empty(),
                                    b.find(".accept").empty(),
                                    b.hide()
                            } else d.refresh(),
                                d.reset(),
                                u.removeClass("disabled"),
                                i("pedding")
                        },
                        d.onUploadProgress = function(b, c) {
                            var d = a("#" + b.id),
                                e = d.find(".progress span");
                            e.css("width", 100 * c + "%"),
                                percentages[b.id][1] = c,
                                fileid = b.id,
                                g()
                        },
                        d.onFileQueued = function(a) {
                            fileCount++,
                                fileSize += a.size,
                            1 === fileCount && (v.addClass("element-invisible"), s.show()),
                                e(a),
                                i("ready"),
                                g()
                        },
                        d.onFileDequeued = function(a) {
                            fileCount--,
                                fileSize -= a.size,
                            fileCount || i("pedding"),
                                f(a),
                                g()
                        },
                        d.on("all",
                            function(a) {
                                switch (a) {
                                    case "uploadFinished":
                                        i("confirm");
                                        break;
                                    case "startUpload":
                                        i("uploading");
                                        break;
                                    case "stopUpload":
                                        i("paused")
                                }
                            }),
                        d.on("uploadSuccess",
                            function(b, c) {
                                return c.message ? (alert(c.message), void d.resetUploader()) : void((c.attachment || c.media_id) && (k++, d.uploadedFiles.push(c), a("#" + b.id).append('<span class="success" style="line-height: 50px;">' + c.width + "x" + c.height + "</span>"), a(".accept").text("成功上传 " + k + " " + typeUnit + j)))
                            }),
                        d.onError = function(a) {
                            return "Q_EXCEED_SIZE_LIMIT" == a ? void alert("错误信息: " + j + "大于 " + c.formatSize(x.fileSizeLimit) + " 无法上传.") : "F_DUPLICATE" == a ? void alert("错误信息: 不能重复上传" + j + ".") : void alert("Eroor: " + a)
                        },
                        u.on("click",
                            function() {
                                if (a(this).hasClass("disabled")) return ! 1;
                                if ("pedding" != state && d.options.isWechat && "video" == d.options.type) {
                                    var b = a('#upload :text[name="title"]').val(),
                                        c = a('#upload textarea[name="introduction"]').val();
                                    if (!b) return util.message("视频标题不能为空"),
                                        !1;
                                    if (!c) return util.message("视频描述不能为空"),
                                        !1;
                                    d.option("formData", {
                                        title: b,
                                        introduction: c
                                    })
                                }
                                "ready" === state ? d.upload() : "paused" === state ? d.upload() : "uploading" === state && d.stop()
                            }),
                        t.on("click", ".retry",
                            function() {
                                d.retry()
                            }),
                        t.on("click", ".ignore",
                            function() {}),
                        u.addClass("state-" + state),
                        g()
                },
                initImageUploader: function() {
                    this.initUploader("image")
                },
                initAudioUploader: function() {
                    this.initUploader("audio")
                },
                initVoiceUploader: function() {
                    this.initUploader("voice")
                },
                initVideoUploader: function() {
                    this.initUploader("video")
                },
                initRemote: function(o) {
                    var b = this;
                    b.modalobj.find("#li_network").removeClass("hide"),
                        b.modalobj.find(".modal-body").append(b.buildHtml().remoteDialog),
                        b.modalobj.find(".btn-primary").click(function() {
                            var c = b.modalobj.find("#networkurl").val();
                            c.length > 0 && "image" == b.options.type && a.getJSON(o, {
                                    url: c
                                },
                                function(a) {
                                    a.message && alert(a.message),
                                    a && (b.finish([a]), a = {})
                                })
                        })
                },
                initVideoRemote: function() {
                    function b(b) {
                        if (b) {
                            var e = c(b);
                            e = d(e),
                                a("#preview").html('<div style="position:absolute;top:0;margin:0;padding:120px 50px;width:100%;height:100%;font-size:20px;"><span>只支持 腾讯，优酷，土豆视频，如无法预览视频，请前往视频网址处的分享区域，复制通用地址到编辑器内部！</span></div><iframe src="' + e + '" allowfullscreen="true" style="border:0;position:absolute;top:0;left:0;margin:0;padding:0;width:100%;height:100%;"></iframe>')
                        }
                    }
                    function c(a) {
                        if (!a) return "";
                        var b, c;
                        if (a.indexOf("v.qq.com") >= 0) {
                            if (b = a.match(/vid\=([^\&]*)($|\&)/), b ? c = "http://v.qq.com/iframe/player.html?vid=" + b[1] + "&tiny=0&auto=0": (b = a.match(/\/([0-9a-zA-Z]+).html/), b && (c = "http://v.qq.com/iframe/player.html?vid=" + b[1] + "&tiny=0&auto=0")), !b) return
                        } else if (a.indexOf("v.youku.com") >= 0) b = a.match(/id_(.*)\.html/),
                            c = "http://player.youku.com/embed/" + b[1];
                        else {
                            if (! (a.indexOf("tudou.com") >= 0)) return;
                            b = a.match(/\/([-\w]+)/g),
                                b = b[b.length - 1].substring(1),
                                c = "http://www.tudou.com/programs/view/html5embed.action?code=" + b
                        }
                        return c
                    }
                    function d(a, b) {
                        return a ? a.replace(b || /[<">']/g,
                            function(a) {
                                return {
                                    "<": "&lt;",
                                    "&": "&amp;",
                                    '"': "&quot;",
                                    ">": "&gt;",
                                    "'": "&#39;"
                                } [a]
                            }) : ""
                    }
                    var e = this;
                    e.modalobj.find("#li_network").removeClass("hide"),
                        e.modalobj.find(".modal-body").append(e.buildHtml().remoteVideoDialog),
                        e.modalobj.find("#networkurl").blur(function() {
                            var c = a(this).val();
                            c.length > 0 ? b(c) : a("#preview").html("")
                        }),
                        e.modalobj.find(".btn-primary").click(function() {
                            var a = e.modalobj.find("#networkurl").val();
                            if (a.length > 0 && "video" == e.options.type) {
                                var b = c(a);
                                b = d(b),
                                    e.finish([{
                                        url: b,
                                        isRemote: !0
                                    }])
                            }
                        })
                },
                initLocal: function() {
                    var a = this;
                    a.modalobj.find("#li_history_image").removeClass("hide"),
                        a.modalobj.find(".modal-body").append(this.buildHtml().localDialog),
                        a.localPage(1)
                },
                localPage: function(c) {
                    let o = this.delete_urls;
                    var d = this;
                    if (d.options.isWechat) var e = d.options.type,
                        f = d.options.mode,
                        g = "./index.php?c=utility&a=wechat_file&do=browser",
                        h = {
                            page: c,
                            type: e,
                            mode: f,
                            psize: 32
                        };
                    else var i = d.modalobj.find("#select-year .btn-info").data("id"),
                        j = d.modalobj.find("#select-month .btn-info").data("id"),
                        g = this.image_urls,
                        h = {
                            page: c,
                            year: i,
                            month: j,
                            psize: 32
                        };
                    var k = d.modalobj.find("#history_image");
                    return a.getJSON(g, h,
                        function(c) {
                            c = c.message.message,
                                k.find(".history-content").css("text-align", "center").html('<i class="fa fa-spinner fa-pulse fa-5x"></i>'),
                                k.find("#image-list-pager").html(""),
                                b.isEmpty(c.items) ? k.find(".history-content").css("text-align", "left").html('<i class="fa fa-info-circle"></i> 暂无数据') : (k.data("attachment", c.items), k.find(".history-content").empty(), k.find(".history-content").html(b.template(d.buildHtml().localDialogLi)(c)), k.find("#image-list-pager").html(c.pager), k.find(".pagination a").click(function() {
                                    d.localPage(a(this).attr("page"))
                                }), k.find(".img-list li").click(function(b) {
                                    d.selectImage(a(b.target).parents("li"))
                                }), d.options.isWechat ? d.weixinDeletefile() : d.deletefile(o))
                        }),
                    d.options.isWechat || d.modalobj.find(".btn-select").unbind("click").click(function() {
                        return a(this).hasClass("btn-info") ? !1 : ("month" == a(this).data("type") && a(this).data("id") > 0 && (d.modalobj.find("#select-year .btn-info").data("id") || (d.modalobj.find("#select-year .btn-select").removeClass("btn-info"), d.modalobj.find("#select-year .btn-select").eq(1).addClass("btn-info"))), a(this).siblings().removeClass("btn-info"), a(this).addClass("btn-info"), void d.localPage(1))
                    }),
                        k.find(".btn-primary").unbind("click").click(function() {
                            var b = [];
                            k.find(".img-item-selected").each(function() {
                                var dd = d.modalobj.find("#history_image").data("attachment");
                                for (cc in dd) {
                                    if (dd[cc].id == a(this).attr("attachid")) {
                                        var ee = dd[cc]
                                    }
                                };
                                b.push(ee),
                                    a(this).removeClass("img-item-selected")
                            }),
                                d.finish(b)
                        }),
                        !1
                },
                deletefile: function(o) {
                    var b = this;
                    b.modalobj.find("#history_image .img-list li .btnClose").unbind().click(function() {
                        var b = a(this),
                            c = a(this).data("id");
                        return c ? (a.post(o, {
                                id: c
                            },
                            // function(a) { !(a.error) ? (b.parent().remove(), util.message("删除成功", "", "success")) : util.message(a.message, "", "error");
                            function(a) { !(a.error) ? (b.parent().remove(), alert("删除成功")) : alert(a.message);
                            }), !1) : !1
                    })
                },
                weixinDeletefile: function() {
                    var b = this;
                    b.modalobj.find(".history .delete-file").off("click"),
                        b.modalobj.find(".history .delete-file").on("click",
                            function(b) {
                                var c = a(this);
                                if (confirm("确定要删除文件吗？")) {
                                    var d = a(this).parent().attr("attachid"),
                                        e = a(this).parent().attr("data-type");
                                    a.post("./index.php?c=utility&a=wechat_file&do=delete", {
                                            id: d
                                        },
                                        function(b) {
                                            var b = a.parseJSON(b);
                                            return b.error ? void("image" == e ? c.parent().remove() : "audio" != e && "voice" != e && "video" != e || c.parents("tr").remove()) : (util.message(b.message), !1)
                                        })
                                }
                                b.stopPropagation()
                            })
                },
                selectImage: function(b) {
                    var c = this;
                    a(b).toggleClass("img-item-selected"),
                        c.options.isWechat ? c.options.direct && c.modalobj.find("#history_image").find(".btn-primary").trigger("click") : c.options.multiple || c.modalobj.find("#history_image").find(".btn-primary").trigger("click")
                },
                initLocalAudio: function() {
                    var a = this;
                    a.modalobj.find("#li_history_audio").removeClass("hide"),
                        a.modalobj.find(".modal-body").append(this.buildHtml().localAudioDialog),
                        a.localAudioPage(1)
                },
                localAudioPage: function(c) {
                    var d = this;
                    if (d.options.isWechat) var e = d.options.type,
                        f = d.options.mode,
                        g = "./index.php?c=utility&a=wechat_file&do=browser",
                        h = {
                            page: c,
                            type: e,
                            mode: f,
                            psize: 5
                        };
                    else var g = "./index.php?c=utility&a=file&do=voice&local=local",
                    // else var g = "./index.php?c=site&a=entry&m=yun_shop&do=shop&route=upload.upload.getImage&local=local&group_id=-999",
                        h = {
                            page: c
                        };
                    var i = d.modalobj.find("#history_audio");
                    return a.getJSON(g, h,
                        function(c) {
                            c = c.message.message,
                                i.find(".history-content").html('<i class="fa fa-spinner fa-pulse"></i>'),
                                b.isEmpty(c.items) ? i.find(".history-content").css("text-align", "center").html('<i class="fa fa-info-circle"></i> 暂无数据') : (i.data("attachment", c.items), i.find(".history-content").empty(), i.find(".history-content").html(b.template(d.buildHtml()[d.options.isWechat ? "weixin_localAudioDialogLi": "localAudioDialogLi"])(c)), i.find("#image-list-pager").html(c.page), i.find(".pagination a").click(function() {
                                    d.localAudioPage(a(this).attr("page"))
                                }), i.find(".js-btn-select").click(function(b) {
                                    a(b.target).toggleClass("btn-primary"),
                                        d.options.isWechat ? d.options.direct && d.modalobj.find("#history_audio").find(".modal-footer .btn-primary").trigger("click") : d.options.multiple || d.modalobj.find("#history_audio").find(".modal-footer .btn-primary").trigger("click")
                                }), d.playAudio(), d.options.isWechat && d.weixinDeletefile())
                        }),
                        i.find(".modal-footer .btn-primary").unbind("click").click(function() {
                            var b = [];
                            i.find(".history-content .btn-primary").each(function() {
                                // b.push(d.modalobj.find("#history_audio").data("attachment")[a(this).attr("attachid")]),
                                var dd = d.modalobj.find("#history_audio").data("attachment");
                                for (cc in dd) {
                                    if (dd[cc].id == a(this).attr("attachid")) {
                                        var ee = dd[cc]
                                    }
                                };
                                b.push(ee),
                                    a(this).removeClass("btn-primary")
                            }),
                                d.finish(b)
                        }),
                        !1
                },
                playAudio: function() {
                    var b = this,
                        c = b.modalobj.find("#history_audio");
                    a(".audio-player-play").click(function() {
                        var b = a(this).attr("attach");
                        if (b) {
                            if (a("#player")[0]) var d = a("#player");
                            else {
                                var d = a('<div id="player"></div>');
                                a(document.body).append(d)
                            }
                            d.data("control", a(this)),
                                d.jPlayer({
                                    playing: function() {
                                        a(this).data("control").find("p").removeClass("fa-play").addClass("fa-stop")
                                    },
                                    pause: function(b) {
                                        a(this).data("control").find("p").removeClass("fa-stop").addClass("fa-play")
                                    },
                                    swfPath: "resource/components/jplayer",
                                    supplied: "mp3,wma,wav,amr",
                                    solution: "html, flash"
                                }),
                                d.jPlayer("setMedia", {
                                    mp3: a(this).attr("attach")
                                }).jPlayer("play"),
                                a(this).find("p").hasClass("fa-stop") ? d.jPlayer("stop") : (c.find(".fa-stop").removeClass("fa-stop").addClass("fa-play"), d.jPlayer("setMedia", {
                                    mp3: a(this).attr("attach")
                                }).jPlayer("play"))
                        }
                    })
                },
                initLocalVoice: function() {
                    this.initLocalAudio()
                },
                initLocalVideo: function() {
                    var a = this;
                    a.modalobj.find("#li_history_video").removeClass("hide"),
                        a.modalobj.find(".modal-body").append(this.buildHtml().localVideoDialog),
                        a.localVideoPage(1)
                },
                localVideoPage: function(c) {
                    var d = this;
                    if (d.options.isWechat) var e = d.options.type,
                        f = "./index.php?c=utility&a=wechat_file&do=browser",
                        g = {
                            page: c,
                            type: e,
                            psize: 5
                        };
                    else var f = this.video_urls,
                        g = {
                            page: c
                        };
                    var h = d.modalobj.find("#history_video");
                    return a.getJSON(f, g,
                        function(c) {
                            c = c.message.message,
                                b.isEmpty(c.items) ? c: c.items = d.foritem(c.items),
                                h.find(".history-content").html('<i class="fa fa-spinner fa-pulse"></i>'),
                                b.isEmpty(c.items) ? h.find(".history-content").css("text-align", "left").html('<i class="fa fa-info-circle"></i> 暂无数据') : (h.data("attachment", c.items), h.find(".history-content").empty(), h.find(".history-content").html(b.template(d.buildHtml()[d.options.isWechat ? "weixin_localVideoDialogLi": "localVideoDialogLi"])(c)), h.find("#image-list-pager").html(c.pager), h.find(".pagination a").click(function() {
                                    d.localVideoPage(a(this).attr("page"))
                                }), h.find(".js-btn-select").click(function(b) {
                                    a(b.target).toggleClass("btn-primary"),
                                        d.options.isWechat ? d.options.direct && d.modalobj.find("#history_video").find(".modal-footer .btn-primary").trigger("click") : d.options.multiple || d.modalobj.find("#history_video").find(".modal-footer .btn-primary").trigger("click")
                                }), d.deletevideofile())
                        }),
                        h.find(".modal-footer .btn-primary").unbind("click").click(function() {
                            var b = [];
                            h.find(".history-content .btn-primary").each(function() {
                                var dd = d.modalobj.find("#history_video").data("attachment");
                                for (cc in dd) {
                                    if (dd[cc].id == a(this).attr("attachid")) {
                                        var ee = dd[cc]
                                    }
                                };
                                b.push(ee),
                                    a(this).removeClass("btn-primary")
                            }),
                                d.finish(b)
                        }),
                        !1
                },
                deletevideofile: function() {
                    var b = this;
                    let o = this.delete_urls;
                    b.modalobj.find("#history_video .history-content td .delete-video-file").unbind().click(function() {
                        if (confirm("确定要删除文件吗？")) {
                            var b = a(this),
                                c = a(this).data("id");
                            return c ? (a.post(o, {
                                    id: c
                                },
                                function(a) { !(a.error) ? (b.parents('tr').remove(), util.message("删除成功", "", "success")) : util.message(a.message, "", "error");
                                }), !1) : !1
                        }
                    })
                },
                finish: function(b) {
                    var c = this;
                    a.isFunction(c.options.callback) && (0 == c.options.multiple ? c.options.callback(b[0]) : c.options.callback(b), c.modalobj.modal("hide"))
                },
                foritem: function(items) {
                    var d = this;
                    for (obj in items) {
                        items[obj].createtime = d.getdate(items[obj].createtime)
                    }
                    return items
                },
                getdate: function(date) {
                    var now = new Date(date * 1000),
                        y = now.getFullYear(),
                        m = now.getMonth() + 1,
                        day = now.getDate();
                    return y + "-" + (m < 10 ? "0" + m: m) + "-" + (day < 10 ? "0" + day: day) + " " + now.toTimeString().substr(0, 8)
                },
                buildHtml: function() {
                    var a = {};
                    var myDate = new Date();
                    var abcd = '';
                    for (var i = myDate.getFullYear(); i > 2012; i--) {
                        abcd += '<a href="javascript:;" data-id="' + i + '" data-type="year" class="btn btn-default btn-select">' + i + '年</a>'
                    }
                    return a.mainDialog = '<div id="modal-webuploader" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">\n <div class="modal-dialog" style="width:660px;">\n       <div class="modal-content">\n           <div class="modal-header">\n                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>\n                <ul class="nav nav-pills" role="tablist">\n                 <li id="li_upload" ' + (!this.options.isWechat && this.options.allowUploadVideo ? 'class="active"': 'class="hide"') + ' role="presentation"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab" onclick="$(\'#select\').hide();">上传</a></li>\n                    <li id="li_upload_perm" ' + (this.options.isWechat ? 'class="active"': 'class="hide"') + ' data-mode="perm" role="presentation"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab" onclick="$(\'#select\').hide();">上传</a></li>\n                    <li id="li_upload_temp" ' + (this.options.isWechat ? "": 'class="hide"') + 'data-mode="temp" role="presentation"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab" onclick="$(\'#select\').hide();">上传</a></li>\n                   <li id="li_network" ' + (this.options.allowUploadVideo ? 'class="hide"': 'class="active"') + ' role="presentation"><a href="#network" aria-controls="network" role="tab" data-toggle="tab" onclick="$(\'#select\').hide();">提取网络' + ("video" == this.options.type ? "视频": "图片") + '</a></li>\n                  <li id="li_history_image" class="hide" role="presentation"><a href="#history_image" aria-controls="history_image" role="tab" data-toggle="tab" onclick="$(\'#select\').show();">浏览图片</a></li>\n                 <li id="li_history_audio" class="hide" role="presentation"><a href="#history_audio" aria-controls="history_audio" role="tab" data-toggle="tab" onclick="$(\'#select\').hide();">浏览音频</a></li>\n                 <li id="li_history_video" class="hide" role="presentation"><a href="#history_video" aria-controls="history_video" role="tab" data-toggle="tab">浏览视频</a></li>\n              </ul>\n         </div>\n' + (this.options.isWechat ? "": '              <div id="select" style="display: none;margin:10px 0 -10px 15px; padding-left:7px;">                 <div id="select-year" style="margin-bottom:10px;">                      <div class="btn-group">                         <a href="javascript:;" data-id="0" data-type="year" class="btn btn-default btn-info btn-select">不限</a>     ' + abcd + '         </div>                  </div>                  <div id="select-month">                     <div class="btn-group">                         <a href="javascript:;" data-id="0" data-type="month" class="btn btn-default btn-info btn-select">不限</a>                         <a href="javascript:;" data-id="1" data-type="month" class="btn btn-default btn-select">1</a>                           <a href="javascript:;" data-id="2" data-type="month" class="btn btn-default btn-select">2</a>                           <a href="javascript:;" data-id="3" data-type="month" class="btn btn-default btn-select">3</a>                           <a href="javascript:;" data-id="4" data-type="month" class="btn btn-default btn-select">4</a>                           <a href="javascript:;" data-id="5" data-type="month" class="btn btn-default btn-select">5</a>                           <a href="javascript:;" data-id="6" data-type="month" class="btn btn-default btn-select">6</a>                           <a href="javascript:;" data-id="7" data-type="month" class="btn btn-default btn-select">7</a>                           <a href="javascript:;" data-id="8" data-type="month" class="btn btn-default btn-select">8</a>                           <a href="javascript:;" data-id="9" data-type="month" class="btn btn-default btn-select">9</a>                           <a href="javascript:;" data-id="10" data-type="month" class="btn btn-default btn-select">10</a>                         <a href="javascript:;" data-id="11" data-type="month" class="btn btn-default btn-select">11</a>                         <a href="javascript:;" data-id="12" data-type="month" class="btn btn-default btn-select">12</a>                     </div>                  </div>              </div>') + '            <div class="modal-body tab-content" style="height:90%;"></div>\n        </div>\n    </div>\n</div>',
                        a.uploaderDialog = '<div role="tabpanel" class="tab-pane upload active" id="upload">\n' + (this.options.isWechat && "video" == this.options.type ? '<form class="form-horizontal hide" style="padding-right:10px;">         <div class="form-group">                <label class="col-xs-12 col-sm-2 control-label">视频标题</label>                <div class="col-sm-10">                 <input type="text" name="title" class="form-control" placeholder="视频标题">                </div>          </div>          <div class="form-group">                <label class="col-xs-12 col-sm-2 control-label">视频描述</label>                <div class="col-sm-10">                 <textarea name="introduction" class="form-control" placeholder="视频描述"></textarea>               </div>          </div></form>': "") + ' <div id="uploader" class="uploader">\n      <div class="queueList">\n           <div id="dndArea" class="placeholder">\n                <div id="filePicker">xx</div>\n' + (this.options.multiple ? '<p id="">或将照片拖到这里，单次最多可选' + (this.options.isWechat ? 5 : 30) + "张</p>\n": '<p id="">或将照片拖到这里</p>\n') + '           </div>\n        </div>\n        <div class="statusBar">\n           <div class="infowrap">\n                <div class="progress">\n                    <span class="text">0%</span>\n                  <span class="percentage"></span>\n              </div>\n                <div class="info"></div>\n              <div class="accept"></div>\n            </div>\n            <div class="btns">\n                <div class="uploadBtn btn btn-primary" style="margin-top: 4px;">确定使用</div>\n                <div class="modal-button-upload" style="float: right; margin-left: 5px;">\n                 <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>',
                        a.remoteDialog = '<div role="tabpanel" class="tab-pane network" id="network">\n <div style="margin-top: 10px;">\n       <form>\n            <div class="form-group">\n              <input type="url" class="form-control" id="networkurl" placeholder="请输入网络图片地址">\n               <input type="hidden" name="network_attachment" value="" >\n             <div id="network-img" class="network-img" style="background-image:url(\'{php echo tomedia(\'images/global/nopic.jpg\');}\')">\n                 <span class="network-img-sizeinfo" id="network-img-sizeinfo"></span>\n              </div>\n            </div>\n        </form>\n   </div>\n    <div class="modal-footer">\n        <button type="button" class="btn btn-primary">确认</button>\n     <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>\n    </div>\n</div>',
                        a.remoteVideoDialog = '<div role="tabpanel" class="tab-pane network' + (this.options.allowUploadVideo ? " ": " active") + '" id="network">\n    <div style="margin-top: 10px;">\n       <form>\n            <div class="form-group">\n              <div style="margin: -10px 0 10px 0;">为了在微信中有更好的体验，推荐使用<a href="http://v.qq.com" target="_blank">腾讯视频</a></div>\n                <input type="url" class="form-control" id="networkurl" placeholder="请输入网络视频地址">\n               <div id="preview" style="position:relative;width:600px;height:300px;margin:0 auto;margin-top:15px;text-align:center;background:#ccc;">\n                </div>\n            </div>\n        </form>\n   </div>\n    <div class="modal-footer">\n        <button type="button" class="btn btn-primary">确认</button>\n     <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>\n    </div>\n</div>',
                        a.localDialog = '<div role="tabpanel" class="tab-pane history" id="history_image">\n    <div class="history-content" style="100%"></div>\n  <div class="modal-footer">\n        <div style="float: left;">\n            <nav id="image-list-pager">\n               <ul class="pager" style="margin: 0;"></ul>\n            </nav>\n        </div>\n        <div style="float: right;">\n       <button ' + (this.options.multiple ? "": 'style="display:none;"') + ' type="button" class="btn btn-primary">确认</button>\n' + (this.options.multiple ? '<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>\n': "") + "       </div>\n    </div>\n</div>",
                        a.localDialogLi = '<ul class="img-list clearfix">\n<%var items = _.sortBy(items, function(item) {return -item.id;});%><%_.each(items, function(item) {%> \n<li class="img-item" attachid="<%=item.id%>" title="<%=item.filename%>">\n   <div class="img-container" style="background-image: url(\'<%=item.url%>\');">\n     <div class="select-status"><span></span></div>\n    </div>\n    <div class="btnClose" data-id="<%=item.id%>"><a href=""><i class="fa fa-times"></i></a></div>\n</li>\n<%});%>\n</ul>',
                        a.weixin_localDialogLi = '<ul class="img-list clearfix">\n<%_.each(items, function(item) {%> \n<li class="img-item" attachid="<%=item.id%>" data-type="image" title="<%=item.filename%>">\n <div class="btnClose delete-file"><a href="javascript:;"><i class="fa fa-times"></i></a></div>  <div class="img-container" style="background-image: url(\'<%=item.url%>\');">\n     <div class="select-status"><span></span></div>\n    </div>\n</li>\n<%});%>\n</ul>',
                        a.localAudioDialog = '<div role="tabpanel" class="tab-pane history" id="history_audio">\n   <div style="height:100%">\n        <table class="table table-hover">\n     <thead class="navbar-inner">\n          <tr>\n              <th>标题</th>\n' + (this.options.isWechat ? '             <th style="width:30%;text-align:right">创建时间</th>\n              <th style="width:30%;text-align:right">\n                   <div class="input-group input-group-sm hide">\n': '             <th style="width:20%;">创建时间</th>\n              <th style="width:30%;">\n                   <div class="input-group input-group-sm">\n') + '                        <input type="text" class="form-control">\n                      <span class="input-group-btn">\n                            <button class="btn btn-default" type="button"><i class="fa fa-search" style="font-size:12px; margin-top:0;"></i></button>\n                     </span>\n                   </div>\n                </th>\n         </tr>\n     </thead>\n      <tbody class="history-content">\n       </tbody>\n  </table></div>\n    <div class="modal-footer">\n        <div style="float: left;">\n            <nav id="image-list-pager">\n               <ul class="pager" style="margin: 0;"></ul>\n            </nav>\n        </div>\n        <div style="float: right;">\n       <button ' + (this.options.multiple ? "": 'style="display:none;"') + ' type="button" class="btn btn-primary">确认</button>\n' + (this.options.multiple ? '<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>\n': "") + "       </div>\n    </div>\n</div>",
                        a.localAudioDialogLi = '<%var items = _.sortBy(items, function(item) {return -item.id;});%><%_.each(items, function(item) {%> \n<tr>\n  <td><a href="#" title="<%=item.filename%>"><%=item.filename%></a></td>\n    <td class="text-right"><%=item.createtime%></td>\n  <td class="text-right">\n       <span class="input-group-btn">\n            <button class="btn btn-default audio-player-play" type="button" attach="<%=item.url%>"><p style="margin:0px;" class="fa fa-play"></p></button>\n            <button attachid="<%=item.id%>" class="btn btn-default js-btn-select">选取</button>\n     </span>\n   </td>\n</tr>\n<%});%>\n',
                        a.weixin_localAudioDialogLi = '<%var items = _.sortBy(items, function(item) {return -item.id;});%><%_.each(items, function(item) {%> \n<tr>\n   <td><a href="<%=item.url%>" target="blank" title="<%=item.filename%>"><%=item.filename%></a></td>\n <td class="text-right"><%=item.createtime%></td>\n  <td class="text-right">\n       <span class="input-group-btn" attachid="<%=item.id%>" data-type="audio">\n          <button class="btn btn-default audio-player-play" type="button" attach="<%=item.url%>"><p style="margin:0px;" class="fa fa-play"></p></button>\n            <button class="btn btn-default delete-file">删除</button>\n           <button attachid="<%=item.id%>" class="btn btn-default js-btn-select">选取</button>\n     </span>\n   </td>\n</tr>\n<%});%>\n',
                        a.localVideoDialog = '<div role="tabpanel" class="tab-pane history" id="history_video">\n   <div style="height:100%">\n        <table class="table table-hover">\n     <thead class="navbar-inner">\n          <tr>\n              <th>标题</th>\n               <th style="width:30%;text-align:right">创建时间</th>\n              <th style="width:30%;text-align:right">\n                   <div class="input-group input-group-sm hide">\n                     <input type="text" class="form-control">\n                      <span class="input-group-btn">\n                            <button class="btn btn-default" type="button"><i class="fa fa-search" style="font-size:12px; margin-top:0;"></i></button>\n                     </span>\n                   </div>\n                </th>\n         </tr>\n     </thead>\n      <tbody class="history-content">\n       </tbody>\n  </table></div>\n    <div class="modal-footer">\n        <div style="float: left;">\n            <nav id="image-list-pager">\n               <ul class="pager" style="margin: 0;"></ul>\n            </nav>\n        </div>\n        <div style="float: right;">\n       <button ' + (this.options.multiple ? "": 'style="display:none;"') + ' type="button" class="btn btn-primary">确认</button>\n' + (this.options.multiple ? '<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>\n': "") + "       </div>\n    </div>\n</div>",
                        a.localVideoDialogLi = '<%var items = _.sortBy(items, function(item) {return -item.id;});%><%_.each(items, function(item) {%> \n<tr>\n  <td><a href="#" title="<%=item.filename%>"><%=item.filename%></a></td>\n    <td class="text-right"><%=item.createtime%></td>\n  <td class="text-right">\n       <span class="input-group-btn">\n  <button data-id="<%=item.id%>" class="btn btn-default delete-video-file">删除</button>\n          <button attachid="<%=item.id%>" class="btn btn-default js-btn-select">选取</button>\n     </span>\n   </td>\n</tr>\n<%});%>\n',
                        a.weixin_localVideoDialogLi = '<%var items = _.sortBy(items, function(item) {return -item.id;});%><%_.each(items, function(item) {%> \n<tr>\n   <td><a href="<%=item.url%>" target="blank" title="<%=item.filename%>"><%=item.filename%></a></td>\n <td class="text-right"><%=item.createtime%></td>\n  <td class="text-right">\n       <span class="input-group-btn" attachid="<%=item.id%>" data-type="audio">\n          <button class="btn btn-default delete-file">删除</button>\n           <button attachid="<%=item.id%>" class="btn btn-default js-btn-select">选取</button>\n     </span>\n   </td>\n</tr>\n<%});%>\n',
                        a
                }
            };
            return d
        });