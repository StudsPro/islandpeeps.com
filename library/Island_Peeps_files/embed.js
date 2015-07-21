if(!window.OpinionStage) {
    window.OpinionStage = {};

    OpinionStage.state = {};
    OpinionStage.functions = {};
    OpinionStage.polls = [];
    OpinionStage.sets = [];
    OpinionStage.polls_locations = {};
    OpinionStage.sets_locations = {};
    OpinionStage.state.initialized = false;
    OpinionStage.state.ready = false;
    OpinionStage.protocol = document.location.protocol == "https:" ? "https:" : "http:";
    // JSON RegExp
    OpinionStage.rvalidchars = /^[\],:{}\s]*$/;
    OpinionStage.rvalidescape = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g;
    OpinionStage.rvalidtokens = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g;
    OpinionStage.rvalidbraces = /(?:^|:|,)(?:\s*\[)+/g;

    OpinionStage.functions.include = Array.prototype.indexOf ?
            function(arr, obj) { return arr.indexOf(obj) !== -1 && typeof arr.indexOf(obj) !== "undefined"; } :
            function(arr, obj) {
                for(var i = -1, j = arr.length; ++i < j;)
                    if(arr[i] === obj) return true;
                return false;
            };

    OpinionStage.trim = function (text) {
        if (text.trim) {
            return text == null ? "" : text.trim();
        }
        return text == null ? "" : text.toString().replace(/^\s+/,'').replace(/\s+$/,'');
    }
    // Code taken from jquery
    OpinionStage.parseJson = function(data) {
        try {
            if (typeof data !== "string" || !data) {
                return null;
            }
            data = OpinionStage.trim(data);
            if (window.JSON && window.JSON.parse) {
                return window.JSON.parse(data);
            }
            if (OpinionStage.rvalidchars.test(data.replace(OpinionStage.rvalidescape, "@")
                    .replace(OpinionStage.rvalidtokens, "]")
                    .replace(OpinionStage.rvalidbraces, ""))) {
                return ( new Function( "return " + data ) )();
            }
            return "";
        } catch(e) {
            return "";
        }
    }
    OpinionStage.addNativeListener = function(event, callback) {
        return window.addEventListener ? window.addEventListener(event, callback, false) : window.attachEvent("on" + event, callback);
    }
    OpinionStage.handleMessage = function(evt) {
        // Verify the message came from 'opinionstage'
        if (evt.origin.indexOf("opinionstage.com") != -1) {
            var msg = OpinionStage.parseJson(evt.data);
            if ((msg.type == "heightChanged") && msg.data) {
                OpinionStage.setFrameHeight(OpinionStage.polls_locations[msg.data.poll_id], msg.data.height);
            } else if ((msg.type == "pollSetHeightChanged") && msg.data) {
                OpinionStage.setFrameHeight(OpinionStage.sets_locations[msg.data.set_id], msg.data.height);
            }
        }
    }
    OpinionStage.addPollLocation = function(poll_id, div_id) {
        OpinionStage.polls_locations[poll_id] = div_id;
    }
    OpinionStage.addPollSetLocation = function(set_id, div_id) {
        OpinionStage.sets_locations[set_id] = div_id;
    }
    OpinionStage.setFrameHeight = function(frame_container_id, height) {
        var frame_div = document.getElementById(frame_container_id);
        if (frame_div != null) {
            var frame = frame_div.getElementsByTagName("IFRAME")[0];
            frame.style.cssText = "height: " + height + "px !important";
        }
    }
    OpinionStage.embedPoll = function(args) {
        if (!OpinionStage.functions.include(OpinionStage.polls, args.poll_id)) {
            OpinionStage.polls.push(args.poll_id);
            OpinionStage.insertIframe("/polls/" + args.poll_id + "/poll", args.width, OpinionStage.polls_locations[args.poll_id])
        }
    }
    OpinionStage.embedPollSet = function(args) {
        if (!OpinionStage.functions.include(OpinionStage.sets, args.set_id)) {
            OpinionStage.sets.push(args.set_id);
            OpinionStage.insertIframe("/sets/" + args.set_id + "/iframe", args.width, OpinionStage.sets_locations[args.set_id])
        }
    }
    OpinionStage.insertIframe = function(path, width, div_id) {
        // Add the iframe with height 0 until visible
        var frame = document.createElement('iframe');
        frame.setAttribute('width', width);
        frame.setAttribute('height','0');
        frame.setAttribute('frameBorder','0');
        frame.setAttribute('scrolling','no');
        frame.setAttribute('style','border: none;margin-bottom: 0 !important');
        frame.setAttribute("src", OpinionStage.protocol + "//www.opinionstage.com" + path);
        frame.setAttribute('name', 'os_frame');
        var frame_div = document.getElementById(div_id);
        frame_div.insertBefore(frame, frame_div.firstChild);
    }
    OpinionStage.waitForCommunication = function(callback, args) {
        if (OpinionStage.state.ready == false) {
            setTimeout(function() { OpinionStage.waitForCommunication(callback, args) } , 100);
        } else {
            callback(args);
        }
    }
    OpinionStage.firstTimeInit = function() {
        if (!OpinionStage.state.initialized) {
            OpinionStage.state.initialized = true;
            // Register to the post message method
            OpinionStage.addNativeListener("message", OpinionStage.handleMessage);
            OpinionStage.state.ready = true;
        }
    }
    OpinionStage.firstTimeInit();
}
OpinionStage.addPollLocation(2190356, "debate_1_" + 2190356);
OpinionStage.waitForCommunication(OpinionStage.embedPoll, {poll_id: 2190356, width: '100%'});