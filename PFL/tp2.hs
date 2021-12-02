import Data.Char
{- Exercise 2.1 Pratical sheet 2 -}

sum' :: Int -> Int 
sum' a = sum[ x^2 | x <- [1..a] ]

{- Exercise 2.2 a) Pratical sheet 2 -}

approx :: Int -> Double
approx n = 4 * sum[ fromIntegral ((-1)^x) / fromIntegral  (2*x+1) | x <- [0..n] ]

{- Exercise 2.2 b) Pratical sheet 2 -}

approx' :: Int -> Double
approx' n = sqrt (12 * sum[ fromIntegral ((-1)^x) / fromIntegral  (x+1)^2 | x <- [0..n] ])

{- Exercise 2.3 Pratical sheet 2 -}

dotProd :: [Float] -> [Float] -> Float
dotProd a b = sum(zipWith (*) a b )

{- Exercise 2.4 Pratical sheet 2 -}

divprop :: Integer -> [Integer]
divprop n = [ x | x <- [1..n-1], mod n x == 0 ]

{- Exercise 2.5 Pratical sheet 2 -}

perfeito :: Integer -> [Integer]
perfeito n = [x | x <- [1..n], sum (divprop x) == x]

{- Exercise 2.6 Pratical sheet 2 -}

pitagoricos :: Integer ->  [(Integer ,Integer ,Integer)]
pitagoricos n = [(x,y,z) | x <- [1..n], y <- [1..n], z <- [1..n], z^2 == x^2 + y^2]

{- Exercise 2.7 Pratical sheet 2 -}

primo :: Integer -> Bool
primo n = length (divprop n) == 1

{- Exercise 2.8 Pratical sheet 2 -}

binom :: Integer -> Integer -> Integer 
binom a b = product [1..a] `div`  (product[1..b] * product[1..(a-b)] )

pascal :: Integer -> [[Integer]]
pascal x = [ l | n <-[1..x], let l = [binom n b | b <- [1..x] ] ]

{- Exercise 2.9 Pratical sheet 2 -}

{- Exercise 2.11 Pratical sheet 2 -}

myconcat :: [[a]] -> [a]
myconcat [] = []
myconcat (x:xs) = x ++ myconcat xs  

myreplicate :: Int -> a -> [a]
myreplicate 0 y = []
myreplicate x y = y:[] ++ (myreplicate (x-1) y)

exclamation :: [a] -> Int -> a
exclamation x (-1) = head x
exclamation x 0 = head x
exclamation (x:xs) y = exclamation xs (y-1)

{- Exercise 2.12 Pratical sheet 2 -}

forte :: String -> Bool
forte s = length s >= 8 && any isDigit s && any isUpper s && any isLower s

{- Exercise 2.13 a) Pratical sheet 2-}

