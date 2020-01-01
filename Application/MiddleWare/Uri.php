<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/27
 * Time: 9:59
 */

namespace Application\MiddleWare;

use Psr\Http\Message\UriInterface;

/**
 * ftp://username:password@website.come:port/path
 *
 * Class Uri
 * @package Application\MiddleWare
 */
class Uri implements UriInterface
{
    protected $uriString;

    protected $uriParts = [];

    protected $queryParams = [];

    public function __construct($uriString)
    {
        $this->uriParts = parse_url($uriString);
        if (!$this->uriParts) {
            throw new \InvalidArgumentException(Constants::ERROR_INVALID_URI);
        }
        $this->uriString = $uriString;
    }

    // http / ftp
    public function getScheme()
    {
        return strtolower($this->uriParts['scheme'] ? '');
    }

    // 获取用户的信息
    public function getUserInfo()
    {
        if (empty($this->uriParts['user'])) {
            return '';
        }

        $val = $this->uriParts['user'];
        if (!empty($this->uriParts['pass'])) {
            $val .= ':' . $this->uriParts['part'];
        }
        return $val;
    }


    // 主机地址 host 该主机名字就是URI中的DNS地址
    public function getHost()
    {
        if (empty($this->uriParts['host'])) {
            return '';
        }
        return $this->uriParts['host'];
    }

    // 端口号
    public function getPort()
    {
        if (empty($this->uriParts['port'])) {
            return NULL;
        } else {
            if ($this->getScheme()) {
                if ($this->uriParts['port'] == Constants::STANDARD_PORTS[$this->getScheme()]) {
                    return NULL;
                }
            }

            return (int)$this->uriParts['port'];
        }
    }

    // 获取URI中位于DNS地址之后的路径信息 path
    public function getPath()
    {
        if (empty($this->uriParts['path'])) {
            return '';
        }

        return implode('/', array_map('rawurlencode', explode('/', $this->uriParts['path'])));
    }

    // 提取query字符串
    public function getQueryParams($reset = false)
    {
        if ($this->queryParams && !$reset) {
            return $this->queryParams;
        }

        $this->queryParams = [];

        if (!empty($this->uriParts['query'])) {
            foreach (explode('&', $this->uriParts['query']) as $keyPairs) {
                list($param, $value) = explode('=', $keyPairs);
                $this->queryParams[$param] = $value;
            }
        }
        return $this->queryParams;
    }


    public function getQuery()
    {
        if (!$this->getQueryParams()) {
            return '';
        }
        $output = '';
        foreach ($this->getQueryParams() as $key => $val) {
            $output .= rawurlencode($key) . '='
                . rawurlencode($val) . '&';
        }
        return substr($output, 0, -1); // 移除最后一个&符号
    }


    public function getFragment()
    {
        if (empty($this->uriParts['fragment'])) {
            return '';
        }
        return rawurlencode($this->uriParts['fragment']);
    }


    public function withScheme($scheme)
    {
        if (empty($scheme) && $this->getScheme()) {
            unset($this->uriParts['scheme']);
        } else {
            if (isset(Constants::STANDARD_PORTS[strtolower($scheme)])) {
                $this->uriParts['scheme'] = $scheme;
            }
        }
    }

    public function withUserInfo($user, $password = null)
    {
        if (empty($user && $this->getUserInfo())) {
            unset($this->uriParts['user']);
        } else {
            $this->uriParts['user'] = $user;

            if ($password) {
                $this->uriParts['pass'] = $password;
            }
        }

        return $this;
    }

    public function withHost($host)
    {
        // TODO: Implement withHost() method.
    }

    public function withPort($port)
    {
        // TODO: Implement withPort() method.
    }

    public function withPath($path)
    {
        // TODO: Implement withPath() method.
    }

    public function withFragment($fragment)
    {
        // TODO: Implement withFragment() method.
    }

    public function getAuthority()
    {
        // TODO: Implement withFragment() method.
    }

    public function withQuery($query)
    {
        if (empty($query) && $this->getQuery()) {
            unset($this->uriParts['query']);
        } else {
            $this->uriParts['query'] = $query;
        }

        // 充值存储查询操作参数的数组
        $this->getQuery();
        return $this;
    }


    public function __toString()
    {
        $uri = ($this->getScheme()) ? $this->getScheme() . '://' : '';

        if ($this->getAuthority()) {
            $uri .= $this->getAuthority();
        } else {
            $uri .= ($this->getHost()) ? $this->getHost() : ' ';
            $uri .= ($this->getPort()) ? $this->getPort() : ' ';
        }

        $path = $this->getPath();
        if ($path) {
            if ($path[0] != '/') {
                $uri .= '/' . $path;
            } else {
                $uri .= $path;
            }
        }

        $uri .= ($this->getQuery()) ? '?' . $this->getQuery() : ' ';
        $uri .= ($this->getFragment()) ? '?' . $this->getFragment() : ' ';

        return $uri;
    }

    // 获取uri地址
    public function getUriString()
    {
        return $this->__toString();
    }
}