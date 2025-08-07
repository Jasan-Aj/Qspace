<?php 
    class Router{

        protected $routes = [];

        public function add($url, $controller, $method){
            $this->routes[] = [
                'url'=> $url,
                'controller'=> $controller,
                'method'=> $method,
                'middleware' => null,
            ];
        }

        public function get($url, $controller){
            $this->add($url,$controller,'GET');
            return $this;
        }

        public function post($url, $controller){
            $this->add($url,$controller,'POST');
            return $this;
        }

        public function delete($url, $controller){
            $this->add($url,$controller,'DELETE');
            return $this;
        }

        public function put($url, $controller){
            $this->add($url,$controller,'PUT');
            return $this;
        }

        public function patch($url, $controller){
            $this->add($url,$controller,'PATCH');
            return $this;
        }

        public function only($key){
            $this->routes[array_key_last($this->routes)]['middleware'] = $key;
            return $this;
        }

        public function route($url,$method){

            $state = false;
            foreach($this->routes as $route){
                
                if($route['url']==$url && $route['method']==$method){

                    if($route['middleware'] == "guest"){
                        if(isset($_SESSION['user_id'])){
                            header('location:'.addRoute('rooms'));
                            exit();
                        }
                        else{
                            require base_path($route['controller']);
                            $state = true;
                        }
                    }

                    elseif($route['middleware'] == "auth"){
                        if(!isset($_SESSION['user_id'])){
                            header('location:'.addRoute('login'));
                            exit();
                        }
                        else{
                            require base_path($route['controller']);
                            $state = true;
                        }
                    }
                    elseif($route['middleware'] == "admin"){
                        if(getUser($_SESSION['user_id']) == 'admin'){
                            require base_path($route['controller']);
                            $state = true;
                        }
                        else{
                            header('location:'.addRoute('rooms'));
                            exit();
                        }
                    }
                    else{
                        require base_path($route['controller']);
                        $state = true;
                    }
                }
                
            }
            if(!$state){
                abort();
            }
        }
    }
?>